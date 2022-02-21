<div class="col-xl-3 col-xl-3 files-sidebar">
    <div class="card border-0">
        <h6 class="card-title">Businesses</h6>
<div id="files"></div>
<script>
    $(function () {
        var jsonData = {
            'data': [
                {
                    'text': 'Contractor',
                    'type': 'business',
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    'children': [
                        {
                            'text': 'Create/Add',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.create.contractor")}}" },
                        },
                        {
                            'text': 'Businesses({{count($businesses)}})',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.contractor.businesses")}}" },
                        },

                    ]
                },
                {
                    'text': 'Vendor/Supplier',
                    'type': 'business',
                    'state': {
                        'opened': true,
                        'selected': true
                    },

                    'children': [
                        {
                            'text': 'Businesses',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.counties")}}" }
                        }

                    ]
                }
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
