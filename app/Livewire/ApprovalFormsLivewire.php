<?php

namespace App\Livewire;

use App\Events\NewNotification;
use App\Models\Forms;
use App\Models\HomeVisitationForms;
use App\Models\Notifications;
use App\Models\RequestForms;
use App\Models\Students;
use App\Models\UserAccounts;
use App\Traits\Notify;
use App\Traits\Toasts;
use Livewire\Component;

class ApprovalFormsLivewire extends Component
{
    use Toasts;
    use Notify;
    public $pending_requestforms, $approved_requestforms, $disapproved_requestforms, $violationForm, $homeVisitationForm;
    public $selectedRequestFormID, $selectedRequestFormType, $disApprovalReason;
    public $my_id, $guidanceID;

    public function mount()
    {
        $this->my_id = session('user_id');
        $this->guidanceID = UserAccounts::find($this->my_id)->hasGuidance->id;
    }

    public function render()
    {
        $this->pending_requestforms = RequestForms::where('status', 'pending')
            ->oldest()->get();
        $this->approved_requestforms = RequestForms::where('status', 'approved')
            ->latest()->get();
        $this->disapproved_requestforms = RequestForms::where('status', 'disapproved')
            ->latest()->get();
        return view('livewire.approval_forms.approval-forms-livewire');
    }

    public function read($type, $id)
    {
        $this->selectedRequestFormID = $id;
        $this->selectedRequestFormType = $type;
        if ($type == 'Violation Form') {
            $requestForm = RequestForms::where('id', $id)->where('form_type', $type)->first();
            $this->violationForm = $requestForm->violationForm;
        } else if ($type == 'Home Visitation Form') {
            $requestForm = RequestForms::where('id', $id)->where('form_type', $type)->first();
            $this->homeVisitationForm = $requestForm->homeVisitationForm;
        }
    }

    public function approveRequest()
    {
        $request = RequestForms::find($this->selectedRequestFormID);
        $request->update([
            'is_approve' => true
        ]);

        $users = [];
        if ($this->selectedRequestFormType == 'Violation Form') {
            $users = [
                $request->teacher->user_account_id,
                ...$request->violationForm->students->pluck('user_account_id')->toArray(),
            ];
            // $request->createViolationForm();
        } else if ($this->selectedRequestFormType == 'Home Visitation Form') {
            $users = [
                $request->teacher->user_account_id,
                $request->homeVisitationForm->student->user_account_id,
            ];
            $form = Forms::create([
                'guidance_id' => $this->guidanceID,
                'teacher_id' => $request->teacher_id,
                'form_type' => $request->form_type, 
            ]);

            $student = Students::find($request->homeVisitationForm->student_id);

            HomeVisitationForms::create([
                'form_id' => $form->id, 
                'student_id' => $student->id, 
                'reason' => $request->homeVisitationForm->reason,
                'parent_id' => $student->parents()->first()->id, 
                'junior_principal_id' => 1, 
                'senior_principal_id' => 2, 
            ]);
        }

        $this->showToast('success', "Requested $this->selectedRequestFormType is Approved Successfully");
        $this->resetFields();

        
        $requestID = $request->form_type == 'Violation Form' ? "VF#{$request->id}" : "RF#{$request->id}";
        $this->notify(
            $this->my_id, 
            $request->teacher->user_account_id, 
            "Your requested $request->form_type ($requestID) is approved",
            'request',
        );

        redirect()->route('guidance-program-page', ['private_schedule' => [
            'users' => $users,
        ]]);
    }

    public function disApproveRequest()
    {
        $validateData = $this->validate([
            'disApprovalReason' => 'required|string'
        ]);

        $request = RequestForms::find($this->selectedRequestFormID);
        $request->update([
            'disapproval_reason' => $validateData['disApprovalReason'],
        ]);


        $this->showToast('success', "Requested Home Visitation Form is Disapproved Successfully");
        $this->resetFields();
        
        $requestID = $request->form_type == 'Violation Form' ? "VF#{$request->id}" : "RF#{$request->id}";
        $this->notify(
            $this->my_id, 
            $request->teacher->user_account_id, 
            "Your requested $request->form_type ($requestID) is disapproved",
            'request',
        );
    }

    public function resetFields()
    {
        $this->violationForm = null;
        $this->homeVisitationForm = null;
        $this->selectedRequestFormID = null;
        $this->disApprovalReason = null;
        $this->resetErrorBag();
        $this->dispatch('closeModals');
    }
}
