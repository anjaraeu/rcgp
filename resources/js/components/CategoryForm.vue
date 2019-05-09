<template>
    <div class="ui segment">
        <form method="POST" class="ui form" @submit.prevent="submitForm" enctype="multipart/form-data">
            <div class="field">
                <input type="text" name="name" placeholder="Name" v-model="dname">
            </div>
            <div class="ui message" v-if="nameconflict">
                <strong>Warning!</strong> This category name already exists!
            </div>
            <div class="field">
                <input type="text" name="slug" placeholder="Slug (URL)" v-model="slug">
            </div>
            <div class="ui message" v-if="slugconflict">
                <strong>Warning!</strong> This category slug already exists!
            </div>
            <div class="field">
                <input type="submit" value="Create" class="ui blue button">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            dname: '',
            slug: '',
            nameconflict: false,
            slugconflict: false
        };
    },

    methods: {
        submitForm(e) {
            if (this.dname == '' || this.slug == '') {
                return false;
            }
            console.log($('.ui.form').serialize());
            axios.post('/api/categories', {
                name: this.dname,
                slug: this.slug
            }).then(res => {
                this.categories.push(res.data);
                new Noty({
                    type: 'success',
                    layout: 'topRight',
                    theme: 'metroui',
                    timeout: 2500,
                    text: '<i class="check icon"></i> Created!'
                }).show();
            }).catch(res => {
                new Noty({
                    type: 'error',
                    layout: 'topRight',
                    theme: 'metroui',
                    timeout: 2500,
                    text: '<i class="exclamation triangle icon"></i> Cannot create category, are you logged in?'
                }).show();
            });
            return true;
        }
    },

    watch: {
        dname(newVal, old) {
            var test = this.categories.filter(val => {return newVal == val.name});
            if (test.length > 0) {
                this.nameconflict = true;
            } else {
                this.nameconflict = false;
            }
        },
        slug(newVal, old) {
            var test = this.categories.filter(val => {return newVal == val.slug});
            if (test.length > 0) {
                this.nameconflict = true;
            } else {
                this.nameconflict = false;
            }
        }
    },

    mounted() {
        $('.ui.dropdown').dropdown();
        axios.get('/api/categories').then(res => {
            this.categories = res.data;
        });
    }
}
</script>

<style>

</style>
