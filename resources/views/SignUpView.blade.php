@component('mail::message')

<h1>Thanks for joining kindfox</h1>
<p>Hi {{ $firstName }}, </p>
<p>We are very delighted that you have joined our application!</p>
<p>Now you just have to give the code to your daycare so they can add you as a customer. As soon as they added you you will see posts and diaries on you messageboard</p>
<h4>This is your code: </h4>
<h5 style="background-color: black; color: white; padding: 15px;"> {{ $user_code }}</h5>
@endcomponent