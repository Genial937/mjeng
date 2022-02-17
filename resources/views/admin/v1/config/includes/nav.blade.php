<div class="col-xl-3 col-xl-3 files-sidebar">
    <div class="card border-0">
        <h6 class="card-title">Configurations</h6>
<div id="files"></div>
<script>
    $(function () {
        var jsonData = {
            'data': [
                {
                    'text': 'Task/Activities',
                    'type': 'folder',
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    'children': [
                        {
                            'text': 'Task',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.task")}}" },
                        },

                    ]
                },
                {
                    'text': 'Project Location',
                    'type': 'folder',
                    'state': {
                        'opened': true,
                        'selected': true
                    },

                    'children': [
                        {
                            'text': 'Counties',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.counties")}}" }
                        },
                        {
                            'text': 'SubCounties',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.subcounties")}}" }
                        },
                    ]
                },
                {
                    'text': 'Materials',
                    'type': 'folder',
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    'children': [
                        {
                            'text': 'Types',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.material.type")}}" }
                        },
                        {
                            'text': 'Classifications',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.material.class")}}" }
                        },

                    ]
                },
                {
                    'text': 'Equipments',
                    'type': 'folder',
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    'children': [
                        {
                            'text': 'Types',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.equipment.type")}}" }
                        },
                        {
                            'text': 'Make',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.equipment.make")}}" }
                        },
                        {
                            'text': 'Model',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.equipment.model")}}" }
                        }
                    ]
                },
                {
                    'text': 'General',
                    'type': 'folder',
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    'children': [
                        {
                            'text': 'Currency',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.currencies")}}" }
                        },
                        {
                            'text': 'Measurement Units',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.measurement.units")}}" }
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
                }
            },
            plugins: ["types"]
        }).on('changed.jstree', function (e, data) {
            var href = data.node.a_attr.href;
            var parentId = data.node.a_attr.parent_id;
            if(href == '#')
                return '';
            window.location.href = href;
        });
    });
</script>
    </div>

</div>
