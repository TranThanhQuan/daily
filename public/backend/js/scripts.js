/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }


    // xử lý delete
    const tableList = document.querySelector('#datatable');
    const deleteForm = document.querySelector('.delete-form');

    if(tableList){
            //bắt sự kiện click của table
            tableList.addEventListener('click', (e) => {
                if(e.target.classList.contains("delete-action")){
                    //vô hiệu hóa load trang
                    e.preventDefault();

                    // hiển thị hộp thoại confirm 
                    Swal.fire({
                        title: "Bạn có muốn xóa?",
                        text: "Không thể khôi phục sau khi xóa!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ok, Đồng ý xóa!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // nếu xác nhận xóa thì 

                            //lấy địa chỉ url gán vào action
                            const action = e.target.href;
                            console.log(action);
                            //gán action vào action của form delete
                            deleteForm.action = action;
                            //submit form delete
                            deleteForm.submit();
                        }
                    });
                }
            })
    }
    
});


const getSlug = (title) => {
    title = $('.title').val();

    // Chuyển tất cả các ký tự thành chữ thường
    let slug = title.toLowerCase();

    // Thay thế các ký tự tiếng Việt có dấu
    const from = "áàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵđ";
    const to   = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyyd";
    for (let i = 0; i < from.length; i++) {
        slug = slug.replace(new RegExp(from[i], 'g'), to[i]);
    }

    // Thay thế khoảng trắng bằng dấu gạch ngang
    slug = slug.replace(/\s+/g, '-');

    // Xóa các ký tự đặc biệt
    slug = slug.replace(/[^a-z0-9-]/g, '');

    // Biến nhiều dấu gạch ngang thành một dấu gạch ngang
    slug = slug.replace(/-+/g, '-');

    // Xóa các dấu gạch ngang ở đầu và cuối chuỗi
    slug = slug.replace(/^-|-$/g, '');
    return slug;
}


$('.title').keyup(function(event) {
    let slug = getSlug();
    $('.slug').val(slug);
});   



//// chỉnh sửa slug thủ công
$('.slug').change(function(event) {
    let slug =  $('.slug').val();

    // kiểm tra input không rỗng và slug hợp lệ
    if(!checkSlug(slug)){
        Swal.fire({
            icon: "error",
            title: "Slug không hợp lệ ...",
            text: "Vui lòng kiểm tra slug",
        });

        $('.btn-submit').addClass('disabled');
        return;
    }

    
    if(slug === ""){
        $('.slug').val(getSlug());
    }
    $('.btn-submit').removeClass('disabled');
});


function checkSlug(slug) {
    // slug rỗng
    if(slug === ""){
        return false;
    }
    // Kiểm tra không có dấu tiếng Việt
    const vietnamesePattern = /[áàảãạăắằẳẵặâấầẩẫậéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵđ]/;
    if (vietnamesePattern.test(slug)) {
        return false;
    }

    // Kiểm tra không có dấu cách
    if (/\s/.test(slug)) {
        return false;
    }

    // Kiểm tra không có chữ in hoa
    if (/[A-Z]/.test(slug)) {
        return false;
    }

    // Kiểm tra không có ký tự đặc biệt
    if (/[^a-z0-9-]/.test(slug)) {
        return false;
    }

    // Nếu tất cả các kiểm tra đều qua, slug hợp lệ
    return true;
}




const logoutAction = document.querySelector('.logout-action');
const logoutForm = document.querySelector('.logout-form');

if(logoutAction && logoutForm) {
    logoutAction.addEventListener('click', e => {
        e.preventDefault();
        document.querySelector('.logout-form').submit();
        const action = e.target.href; 
        logoutForm.action = action
        logoutForm.submit();
    }); 
}




