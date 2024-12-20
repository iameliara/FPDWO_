var noTemplateMap = {
    'admin.login': true,
    'pegawai.login': true
};

var hashMap = {
    'admin.login': 'admin/login.html',
    'admin.dashboard': 'admin/dashboard.html',
    'admin.pegawai.tambah': 'admin/pegawai/edit.html',
    'admin.pegawai.list': 'admin/pegawai/list.html',
    'admin.pegawai.edit': 'admin/pegawai/edit.html',
    'admin.cuti.buat': 'admin/cuti/buat.html',
    'admin.cuti.list': 'admin/cuti/list.html',
    'admin.cuti.detail': 'admin/cuti/detail.html',
    'pegawai.login': 'pegawai/login.html',
    'pegawai.dashboard': 'pegawai/dashboard.html',
    'pegawai.cuti.ajukan': 'pegawai/cuti/ajukan.html',
    'pegawai.cuti.riwayat': 'pegawai/cuti/riwayat.html',
    'pegawai.cuti.status': 'pegawai/cuti/status.html'
};

$(document).ready(function() {
    if (location.hash.length == 0) {
        location.href = '#admin.login';
    }

    var hash = location.hash.substring(1);
    if (hash.length > 0) {
        var noTemplate = (typeof(noTemplateMap[hash]) == 'boolean') && noTemplateMap[hash];
        if (noTemplate) {
            $.get(hashMap[hash]).done(function(html) {
                $('#main-content').html(html);
            });
        } else {
            if (typeof(hashMap[hash]) != 'undefined') {
                var component = hash.match(/^([^.]+)\..+$/)[1];

                $.get(component + '/sidebar.html').done(function(html) {
                    $('.nav-content').html(html);
                    $('.menu-title').text(component.toUpperCase());

                    $('.nav-content .nav-menu[href="' + location.hash + '"]').addClass('active');

                    $.get(hashMap[hash]).done(function(html) {
                        $('#content').html(html);
                        $('.nav-menu').on('click', function(e) {
                            e.preventDefault();
                            location.assign($(this).attr('href'));
                            location.reload();
                        });
                    });
                });
            } else {
                $('#main-content').html('Page not found');
            }
        }
    }
});

