function playSound(url) {
  const audio = new Audio(url);
  audio.play();
}

// Toggle card

$(document).on('click', '#notification-bell', function() {
    $('div.toggle_card').toggleClass('hidden');
});

// NOTIFICATION LISTENER
var notificationsWrapper   = $('.dropdown-notifications');
var notificationsToggle    = notificationsWrapper.find('button[data-bs-toggle]');
var notificationsCountElem = notificationsToggle.find('.badge');
var notificationsCount     = parseInt(notificationsCountElem[0].innerHTML);
var notifications          = notificationsWrapper.find('.notification-cards');

<<<<<<< HEAD
var pusher = new Pusher('339e0dee5dbe07dcdccd', {
=======
pusher_key = $('#pusher_key')[0].innerHTML;
var pusher = new Pusher(pusher_key, {
>>>>>>> 057990c3dcf0c1f0f975325c51b5766974f29480
  cluster: 'eu'
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('new-post'); // new post posted by company
var channel2 = pusher.subscribe('new-comment'); // new comment posted by company
var channel3 = pusher.subscribe('new-usercomment'); // new comment posted by mainuser

// Bind a function to a Event (the full Laravel class)
channel.bind('App\\Events\\NewPost', function(data) {
  var user_id = $('#hidden_user_id')[0].innerHTML;
  if (data.users.includes(parseInt(user_id))) {
    var existingNotifications = notifications.html();
    var newNotificationHtml = `
    <div class="d-flex p-4 align-items-center justify-content-between border bg-light">
      <div class="">
        <i class="fas fa-envelope text-danger mx-2"></i><a class="new-message" href="#">${data.message}</a>
      </div>
      <small>Just now</small>
    </div>
    `;
    notifications.html(newNotificationHtml + existingNotifications);

    notificationsCount += 1;

    playSound('https://kindfoxlaravel.s3.eu-west-3.amazonaws.com/mixkit-positive-notification-951.wav');

    var bell = $('#notification-bell')
    bell.animate({ "top": "-=8px"}, "fast");
    bell.animate({ "top": "+=8px"}, "fast");

    notificationsCountElem[0].innerHTML = notificationsCount;
  }

});

// Bind a function to a Event (the full Laravel class)
channel2.bind('App\\Events\\NewComment', function(data) {
  var user_id = $('#hidden_user_id')[0].innerHTML;
  if (data.users.includes(parseInt(user_id))) {
    var existingNotifications = notifications.html();
    var newNotificationHtml = `
    <div class="d-flex p-4 align-items-center justify-content-between border bg-light">
      <div class="">
        <i class="fas fa-envelope text-danger mx-2"></i><a class="new-message" href="#">${data.message}</a>
      </div>
      <small>Just now</small>
    </div>
    `;
    notifications.html(newNotificationHtml + existingNotifications);

    notificationsCount += 1;

    playSound('https://kindfoxlaravel.s3.eu-west-3.amazonaws.com/mixkit-positive-notification-951.wav');

    var bell = $('#notification-bell')

    bell.animate({ "top": "-=8px"}, "fast");
    bell.animate({ "top": "+=8px"}, "fast");


    notificationsCountElem[0].innerHTML = notificationsCount;
  }

});

// Bind a function to a Event (the full Laravel class)
channel3.bind('App\\Events\\NewUserComment', function(data) {
  var dashboard_company_id = $('#hidden_company_id');
  var user_company_id = $('#hidden_user_company_id');

if (Object.keys(dashboard_company_id).length === 0) { // on messageboard
  var user_id = $('#hidden_user_id')[0].innerHTML;
  if (data.users.includes(parseInt(user_id))) {
    var existingNotifications = notifications.html();
    var newNotificationHtml = `
    <div class="d-flex p-4 align-items-center justify-content-between border bg-light">
      <div class="">
        <i class="fas fa-envelope text-danger mx-2"></i><a class="new-message" href="#">${data.message}</a>
      </div>
      <small>Just now</small>
    </div>
    `;
    notifications.html(newNotificationHtml + existingNotifications);

    notificationsCount += 1;

    playSound('https://kindfoxlaravel.s3.eu-west-3.amazonaws.com/mixkit-positive-notification-951.wav');

    var bell = $('#notification-bell')
    bell.animate({ "top": "-=8px"}, "fast");
    bell.animate({ "top": "+=8px"}, "fast");

    notificationsCountElem[0].innerHTML = notificationsCount;
  }
} else if(Object.keys(user_company_id).length === 0) { // on dashboard
    if (dashboard_company_id[0].innerHTML == data.company_id) {
      var existingNotifications = notifications.html();
    var newNotificationHtml = `
    <div class="d-flex p-4 align-items-center justify-content-between border bg-light">
      <div class="">
        <i class="fas fa-envelope text-danger mx-2"></i><a class="new-message" href="#">${data.message}</a>
      </div>
      <small>Just now</small>
    </div>
    `;
    notifications.html(newNotificationHtml + existingNotifications);
    notificationsCount += 1;

    playSound('https://kindfoxlaravel.s3.eu-west-3.amazonaws.com/mixkit-positive-notification-951.wav');

    var bell = $('#notification-bell')
    bell.animate({ "top": "-=8px"}, "fast");
    bell.animate({ "top": "+=8px"}, "fast");

    notificationsCountElem[0].innerHTML = notificationsCount;
    }
}

});