export default class Table {

    create(customOptions = {}) {

        if ($.fn.DataTable.isDataTable('#table_dt')) {
            $('#table_dt').DataTable().destroy();
        }
        
        $('#table_dt').DataTable({
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            order: [[0, 'desc']], // orden por defecto
            oLanguage: {
                oPaginate: {
                    sPrevious: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline></svg>`,
                    sNext: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline></svg>`
                },
                sInfo: "Mostrando página _PAGE_ de _PAGES_",
                sSearch: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-search"><circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>`,
                sSearchPlaceholder: "Buscar...",
                sLengthMenu: "Resultados :  _MENU_"
            },
            stripeClasses: [],
            lengthMenu: [70, 100],
            pageLength: 70,

            // 🔁 Sobrescribir con las opciones personalizadas si las hay
            ...customOptions
        });
    }

    destroy() {
        if ($.fn.DataTable.isDataTable('#table_dt')) {
            $('#table_dt').DataTable().destroy();
        }
    }

}
