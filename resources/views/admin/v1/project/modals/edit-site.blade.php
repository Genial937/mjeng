<div class="modal fade" id="edit-site" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">

                 <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
                    <i class="ti-close"></i>
                </button>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-8 offset-2">
                            <h5 class="modal-title">
                                <figure class="avatar avatar-sm mr-3">
                                    <span class="avatar-title bg-warning text-black-50 rounded-pill">
                                        <i class="ti-user"></i>
                                    </span>
                                </figure>
                                Edit Project Site</h5>
                            <hr>
                            <form class="margin-10-p" id="edit-project-site-form"
                                  action="{{route("admin.update.project.sites")}}">
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="site-name">Site name</label>
                                        <input type="text" class="form-control" id="modal-input-site-name" name="name"
                                               placeholder="Site name e.g Mombasa-Syokimau Extension" required>
                                    </div>

                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="project-description">Description</label>
                                        <textarea class="form-control" id="modal-input-site-description"
                                                  name="description" required placeholder="Construction of Athi River Bridge "></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="end-date">Choose a task e.g excavating</label>
                                        <select class="form-select-2" multiple name="tasks[]" required id="modal-input-site-tasks">
                                            @if(!empty($tasks))
                                                @foreach($tasks as $task)
                                                    <option class="text-capitalize"
                                                            value="{{$task->id}}">{{$task->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="site_id" id="modal-input-site-id" >
                                <button class="btn btn-primary btn-rounded  btn-edit-project-site" type="submit">
                                    Save Changes
                                </button>
                            </form>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
