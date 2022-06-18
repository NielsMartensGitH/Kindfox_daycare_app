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

var pusher = new Pusher('37bf16ffde40c77bee7d', {
  cluster: 'eu'
});

console.log(pusher);

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('new-post');
var channel2 = pusher.subscribe('new-comment');

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
      <small>2 hours ago</small>
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
console.log("check")
  if (data.users.includes(parseInt(user_id))) {
    var existingNotifications = notifications.html();
    var newNotificationHtml = `
    <div class="d-flex p-4 align-items-center justify-content-between border bg-light">
      <div class="">
        <i class="fas fa-envelope text-danger mx-2"></i><a class="new-message" href="#">${data.message}</a>
      </div>
      <small>2 hours ago</small>
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