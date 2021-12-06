
function Pagination() {
         $(document).on('click','.pagination a',function(e){
            e.preventDefault();
            page = $(this).attr('href').split('?page=')[1];
            // if($('#input-search').val() != ''){
            //     searchPage(page);
            // }else{
            //     loadPage(page);
            // }
             loadPage(page);
             
         });
     
    };