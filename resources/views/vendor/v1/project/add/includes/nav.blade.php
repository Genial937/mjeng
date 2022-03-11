<div class="col-xl-3 col-xl-3 files-sidebar">
    <div class="card border-0">
        <h6 class="card-title"></h6>
<div id="files"></div>
<script>
    $(function () {
        var jsonData = {
            'data': [
                {
                    'text': 'Equipments Required',
                    'type': 'business',
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    'children': [
                        {
                            'text': 'View List',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("vendor.project.equipment.required",$project->id)}}" },
                        }
                    ]
                },
                {
                    'text': 'Materials Required',
                    'type': 'business',
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    'children': [

                        {
                            'text': 'View List',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("vendor.project.material.required",$project->id)}}" },
                        }
                    ]
                },
            ],
            themes: {
                dots: true
            }
        };

        $('#files').jstree({
            'core': jsonData,
            "types": {
                "folder": {
                    "icon": "ti-folder text-warning",
                },
                "file": {
                    "icon": "ti-file",
                },
                "business": {
                    "icon": "ti-briefcase",
                }
            },
            plugins: ["types"]
        }).on('changed.jstree', function (e, data) {
            try {
                var href = data.node.a_attr.href;
                if (href === '#')
                    return '';
                window.location.href = href;
            }catch (e) {
                //log
                console.log(e.message);
            }
        });
    });
</script>
    </div>

</div>
