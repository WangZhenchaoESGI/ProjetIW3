<body>
<div class="grid">
    <div class="grid__col--7">
        <form class="form">
            <label class="form__label--hidden" for="name">Name:</label>
            <input class="form__input" type="text" id="name" placeholder="Name">

            <label class="form__label--hidden" for="email">Email:</label>
            <input class="form__input" type="email" id="email" placeholder="email@website.com">

            <label class="form__label--hidden" for="msg">Message:</label>
            <textarea class="form__input" id="msg" placeholder="Message..." rows="7"></textarea>

            <input class="btn--default" type="submit" value="Submit">
            <input class="btn--warning" type="reset" value="Reset">
        </form>
    </div>
    <div class="grid__col--4">
        <img class="img--avatar" src="../public/img/avatar.png" alt="Avatar">
        <form>
            <label class="form__label--hidden" for="username">Username:</label>
            <input class="form__input" type="text" id="username" placeholder="Username">
            <label class="form__label--hidden" for="password">Password:</label>
            <input class="form__input" type="password" id="password" placeholder="Password">
            <input class="form__btn" type="submit" value="Login">
        </form>
    </div>
</div>
</body>