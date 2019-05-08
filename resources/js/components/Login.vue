<template>
    <div class="ui segment">
        <h2 class="ui center aligned header">Login</h2>

        <form method="POST" class="ui form" @submit.prevent="submitForm">
            <div class="field">
                <label for="email">E-Mail Address</label>
                <input id="email" type="email" name="email" value="" required autofocus autocomplete="email" v-model="email">
            </div>

            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" v-model="password">
            </div>

            <div class="field">
                <div class="ui checkbox">
                    <input class="hidden" tabindex="0" type="checkbox" name="remember" id="remember" v-model="remember">

                    <label for="remember">
                        Remember Me
                    </label>
                </div>
            </div>

            <button type="submit" class="ui primary button">
                Login
            </button>

            <!-- <a class="ui button" href="#/passwordforgot">
                Forgot Your Password?
            </a> -->
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
            remember: false
        }
    },

    methods: {
        submitForm() {
            axios.post('/login', {
                email: this.email,
                password: this.password,
                remember: (this.remember) ? true:null
            });
        }
    },

    mounted() {
        $('.ui.checkbox').checkbox();
    }
}
</script>
