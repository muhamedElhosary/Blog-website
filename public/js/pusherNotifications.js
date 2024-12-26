// تحديد العنصر الذي يحتوي على عداد الإشعارات
var notificationsWrapper = $('.nav-item.dropdown-notifications'); // العنصر الرئيسي
var notificationsCountElem = notificationsWrapper.find('.notif-count'); // عداد الإشعارات
var notificationsCount = parseInt(notificationsCountElem.data('count')) || 0; // الحصول على العدد الحالي أو 0 إذا لم يكن موجودًا

// الاشتراك في قناة Pusher
var channel = pusher.subscribe('new-notification');

// الاستماع إلى الحدث
channel.bind('App\\Events\\SendNotification', function (data) {
    // تحديث عدد الإشعارات
    notificationsCount += 1; // زيادة العدد
    notificationsCountElem.attr('data-count', notificationsCount); // تحديث الخاصية data-count
    notificationsCountElem.text(notificationsCount); // تحديث النص المرئي

    if (notificationsCount > 0) {
        notificationsWrapper.show();
    }

});

