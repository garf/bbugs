<div>
    <b><@ trans('email.hello', array('name' => $name)) @></b>

    <p>
        <@ trans('email.signup.thanks') @>
    </p>
    <p>
        <@ trans('email.signup.your_credentials') @>
        <br />
        <br />
        <@ trans('email.signup.email') @>: <b><@ $email @></b>
        <br />
        <@ trans('email.signup.password') @>: <b><@ $password @></b>
        <br />
        <br />
        <a href="<@ URL::route('index', ['#login']) @>"><@ trans('email.signup.authorization') @></a>
    </p>
</div>