<div class="col-xl-3 col-xl-3 files-sidebar">
    <div class="card border-0">
        <h6 class="card-title">Businesses</h6>
<div id="files"></div>
<script>
    $(function () {
        var jsonData = {
            'data': [
                {
                    'text': 'Contractor Businesses',
                    'type': 'folder',
                    'state': {
                        'opened': true,
                        'selected': true
                    },
                    'children': [
                        {
                            'text': 'View',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.contractor.businesses")}}" },
                        },

                    ]
                },
                {
                    'text': 'Vendor/Supplier Businesses',
                    'type': 'folder',
                    'state': {
                        'opened': true,
                        'selected': true
                    },

                    'children': [
                        {
                            'text': 'Approved',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.counties")}}" }
                        },
                        {
                            'text': 'Pending Approval',
                            'type': 'file',
                            "a_attr" : { "href" : "{{route("admin.subcounties")}}" }
                        },
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
