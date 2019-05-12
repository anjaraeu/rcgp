<template>
    <div class="ui segment">
        <form method="POST" class="ui form" @submit.prevent="submitForm" enctype="multipart/form-data">
            <div class="field">
                <input type="file" accept="image/*" name="image" id="image" @change="loadImage" required>
            </div>
            <div class="field">
                <input type="text" name="src" placeholder="Source" v-model="src" required>
            </div>
            <div class="field">
                <div class="ui selection dropdown" v-bind:class="{ loading: categories === [] }">
                    <input type="hidden" name="category" @change="categorySet" required>
                    <i class="dropdown icon"></i>
                    <div class="default text">Category</div>
                    <div class="menu">
                        <div class="item" v-for="category in categories" :data-value="category.id">{{ category.name }}</div>
                    </div>
                </div>
            </div>
            <div class="field">
                <input type="submit" value="Upload" class="ui blue button">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            src: '',
            image: null,
            category: '',
            csrf: ''
        };
    },

    methods: {
        categorySet(e) {
            this.category = $(e.target).val();
        },
        loadImage(e) {
            console.log(e);
            this.image = e.target.files[0];
            console.log(image);
            return true;
        },
        submitForm(e) {
            let formData = new FormData();
            formData.append('image', this.image);
            formData.append('src', this.src);
            formData.append('category', this.category);
            formData.append('_token', this.csrf);
            console.log($('.ui.form').serialize());
            axios.post('/api/image', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(res => {
                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    theme: 'metroui',
                    timeout: 2500,
                    text: '<i class="check icon"></i> Uploaded!'
                }).show();
            }).catch(err => {
                new Noty({
                    type: 'error',
                    layout: 'topRight',
                    theme: 'metroui',
                    timeout: 2500,
                    text: '<i class="exclamation triangle icon"></i> Cannot add image, are you logged in?'
                }).show();
            });
            return true;
        }
    },

    mounted() {
        $('.ui.dropdown').dropdown();
        axios.get('/api/categories').then(res => {
            this.categories = res.data;
        });
        axios.get('/api/csrftoken').then(res => {
            this.csrf = res.data.token;
        });
    }
}
</script>

<style>

</style>
