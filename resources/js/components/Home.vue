<template>
    <div class="ui segment">
        <img :src="'storage/' + image.path" @click="reload">
        <select id="category" class="ui dropdown" @change="setCategory">
            <option value="default" selected>All (Default)</option>
            <option v-for="category in categories" :value="category.slug" v-text="category.name"></option>
        </select>
    </div>
</template>

<script>
export default {
    data() {
        return {
            category: '',
            categories: [],
            image: {category_id: 1, name: null, src: null, path: null}
        }
    },

    mounted() {
        axios.get('/api/image/'+this.category).then(res => {
            this.image = res.data;
        });
        axios.get('/api/categories').then(res => {
            this.categories = res.data;
        });
        $('#category').dropdown();
    },

    methods: {
        reload() {
            axios.get('/api/image/'+this.category).then(res => {
                this.image = res.data;
            });
        },
        setCategory() {
            var category = $('#category').dropdown('get value');
            if (category == 'default') {
                this.category = '';
            } else {
                this.category = category;
            }
            this.reload();
        }
    }
}
</script>

<style lang="scss">
img {
    max-width: 100%;
}
</style>
