<div x-data='{ rows: {} }'>
    <div style="margin-left: 2rem; margin-right: 2rem;">
        <div class="row">
            <div class="col-2">
                <label for="per-page" style="font-weight: normal; margin-top: 1rem;">
                    Show
                    <span>
                        <select class="form-select form-select-sm mb-2" id='per-page' selected
                            wire:model.live.debounce.500ms="per_page">
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>25</option>
                            <option selected>30</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                    </span>
                    Entries
                </label>
            </div>

            <div class='col-8 d-flex justify-content-end'>
                <div class="input-group input-group-sm" style="width: 50%;">
                    <input class="form-control float-right" name="table_search" placeholder="Search"
                        style="height: 35px;" type="text" wire:model.live.debounce.500ms.debounce.500ms='search'>
                    <div class="input-group-append">
                        <button style="height: 35px;" aria-expanded="false" aria-haspopup="true"
                            class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown"
                            type="button">Role</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" wire:click="$set('filterRole', 'All')">All</a>
                            @foreach ($roles as $roleFilter)
                                <a class="dropdown-item" href="#"
                                    wire:click="$set('filterRole', '{{ $roleFilter->role }}')">{{ $roleFilter->role }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class='col-2'>
                <label for="per-page" style="font-weight: normal; margin-top: 1rem; margin-left: 1rem; cursor: pointer;"
                    wire:click='markArchive(Object.keys(rows).filter(key => rows[key] === true))'
                    x-show='Object.values(rows).includes(true)'>
                    <span class="archivals btn btn-default"
                        style="transition: color 0.3s; color: white; background-color: #0A0863; border-radius: 20px; font-size: 14px;">Mark
                        as Archive</span>
                </label>
            </div>
        </div>
    </div>
    <div class="card" style="margin-left: 2rem; margin-right: 2rem;border-radius: 10px;">
        <div wire:loading
            wire:target='search, filterRole, sortBy, store, update, delete, archive, unArchive, markArchive, markUnarchive, deleteSelected'>
            <div class="overlay" style="position: absolute; width: 100%; height: 100%;">
                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="border: 1px solid #252525; border-radius: 10px;">
            <table class="table table-hover" x-data="{ selectAll: false }">
                <thead style="color: white; background-color: #7684B9; text-align: center;">
                    <tr>
                        <th
                            x-on:click="selectAll = !selectAll; Object.keys(rows).forEach(function(key) {rows[key] = selectAll;})">
                            <input type="checkbox" x-model="selectAll">
                        </th>
                        <x-table-column-header :direction="$sortField === 'id' ? $sortDirection : null" click="sortBy('id')" label='ID' sortable />
                        <x-table-column-header :direction="$sortField === 'name' ? $sortDirection : null" click="sortBy('name')" label='Name' sortable />
                        <x-table-column-header :direction="$sortField === 'email' ? $sortDirection : null" click="sortBy('email')" label='Email' sortable />
                        <x-table-column-header :direction="$sortField === 'role' ? $sortDirection : null" click="sortBy('role')" label='Role' sortable />
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach ($users as $user)
                        <tr
                            @if ($my_id !== $user->id) x-bind:class="rows[{{ $user->id }}] ? 'bg-lightblue' : ''" x-init='rows[{{ $user->id }}] = false' x-on:click='rows[{{ $user->id }}] = !rows[{{ $user->id }}]' @endif>
                            <th>
                                <input @disabled($my_id == $user->id) type="checkbox"
                                    @if ($my_id !== $user->id) x-model="rows[{{ $user->id }}]" @endif>
                            </th>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <!--VIEW PROFILE-->
                                <button class="btn btn-primary action-btn" data-target="#view-user-btn"
                                    data-toggle="modal" title='View Account' tooltip='enable'
                                    wire:click="get_data({{ $user->id }})">
                                    <i aria-hidden="true" class="fa fa-eye"></i>
                                </button>

                                @if ($my_id !== $user->id)
                                    <!--USER INFO EDIT BUTTON-->
                                    @if (in_array("Edit{$user->role}Accounts", $privileges) || in_array('EditAccounts', $privileges))
                                        <button class="btn btn-primary action-btn" data-target="#stud-info-edit"
                                            data-toggle="modal" title='Edit Account' tooltip='enable'
                                            wire:click="get_data({{ $user->id }})">
                                            <i class="fa fa-solid fa-pen"></i>
                                        </button>
                                    @endif

                                    {{-- ARCHIVE USER --}}
                                    @if (in_array("Archive{$user->role}Accounts", $privileges) || in_array('ArchiveAccounts', $privileges))
                                        <button class="btn btn-primary action-btn" title='Archive Account'
                                            tooltip='enable' wire:click="archive({{ $user->id }})">
                                            <i aria-hidden="true" class="fa fa-archive"></i>
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    {{ $users->links('components.pagination') }}

</div>
