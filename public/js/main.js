function csrfHeader() {
    return {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };
}

 

function loadHtml(target,url){
    $(target).html(`
    <div class='text-center my-5'>
        <div class='spinner-border  '></div>
    </div>`)
    .load(url);
}