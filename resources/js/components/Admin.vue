<template>
    <div class="ui segment">
        <div class="ui grid">
            <div class="four column row">
                <div class="left floated left aligned column">
                    <div class="ui statistic">
                        <div class="value">
                            <i class="image icon"></i>
                            {{ data.images }}
                        </div>
                        <div class="label">
                            Images
                        </div>
                    </div>
                </div>
                <div class="center aligned column">
                    <h2>Welcome to admin dashboard<span v-if="user.ok">, {{ user.name }}</span>!</h2>
                </div>
                <div class="right floated right aligned column">
                    <div class="ui statistic">
                        <div class="value">
                            <i class="folder icon"></i>
                            {{ data.categories }}
                        </div>
                        <div class="label">
                            Categories
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: {images: '...', categories: '...'},
            user: {ok: false, name: ''}
        }
    },

    mounted() {
        axios.get('/api/statistics').then(res => {
            this.data = res.data;
        });
        axios.get('/api/loggedin').then(res => {
            this.user = res.data;
        });
    }
}
</script>
