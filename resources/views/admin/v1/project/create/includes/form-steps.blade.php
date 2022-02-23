<div class=" row margin-5-p">
    <div class="col-md-10 offset-1 text-left">
        <nav>
            <ol class="cd-breadcrumb triangle">
                <li><a href="#"   class="btn {{ Request::is('admin/projects/form/create/details/*') ? 'btn-gradient-success' : ' btn-gradient-warning'}}  btn-uppercase btn-lg text-white ">1. Details</a></li>
                <li><a href="#" class="btn {{ Request::is('admin/projects/form/create/site/*') ? 'btn-gradient-success' : ' btn-gradient-warning'}} btn-uppercase btn-lg text-white">2. Sites</a></li>
                <li><a href="#" class="btn {{ Request::is('admin/projects/form/create/equipment/*') ? 'btn-gradient-success' : ' btn-gradient-warning'}} btn-uppercase btn-lg text-white">3. Equipment Required</a></li>
                <li><a href="{{route("admin.create.project.material.required")}}" class="btn btn-apple btn-uppercase btn-lg text-white">4. Material Required</a></li>
            </ol>
        </nav>
    </div>
</div>



