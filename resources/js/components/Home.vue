<template>
    <div class="ui segment">
        <img :src="'/storage/' + image.path" @click="reload">
        <p>
            <a :href="'/storage/' + image.path">{{ image.name }}</a> from <em>{{ image.src }}</em>
        </p>
        <select id="category" class="ui dropdown" @change="setCategory">
            <option value="default" selected>All (Default)</option>
            <option v-for="category in categories" :value="category.slug" v-text="category.name"></option>
        </select>
        <a href="javascript:;" class="ui labeled icon yellow button" @click="share('email')">
            <i class="envelope icon"></i>
            E-Mail
        </a>
        <a href="javascript:;" class="ui labeled icon twitter button" @click="share('twitter')">
            <i class="twitter icon"></i>
            Twitter
        </a>
        <a href="javascript:;" class="ui labeled icon facebook button" @click="share('facebook')">
            <i class="facebook f icon"></i>
            Facebook
        </a>
        <a href="javascript:;" class="ui labeled icon black button" @click="share('diaspora')">
            <i class="rcgp-icon-diaspora icon"></i>
            Diaspora*
        </a>
        <a href="javascript:;"  class="ui labeled icon blue button" @click="share('mastodon')">
            <i class="rcgp-icon-mastodon icon"></i>
            Mastodon
        </a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            category: '',
            categories: [],
            image: {id: -1, category_id: 1, name: null, src: null, path: null}
        }
    },

    mounted() {
        if (this.$route.params.imgid) {
            axios.get('/api/image-id/'+this.$route.params.imgid).then(res => {
                this.image = res.data;
            });
        } else {
            axios.get('/api/image/'+this.category).then(res => {
                this.image = res.data;
            });
        }
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
        },
        share(method) {
            var url = encodeURIComponent(new URL('img/' + this.image.id, process.env.MIX_APP_URL));
            console.log(url);
            switch (method) {
                case 'email':
                    window.location.href = 'mailto:?subject=Random%20Cute%20Girls%20Programming&body=See%20that%20RCGP%20image!%0A' + url;
                    break;

                case 'twitter':
                    window.open('https://twitter.com/share?url=' + url + '&text=Random%20Cute%20Girls%20Programming','rcgpshare','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550');
                    break;

                case 'facebook':
                    window.open('https://www.facebook.com/sharer/sharer.php?href=' + url,'rcgpshare','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550');
                    break;

                case 'diaspora':
                    window.open('http://sharetodiaspora.github.io/?url=' + url + '&title=Random%20Cute%20Girls%20Programming','rcgpshare','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550');
                    break;

                case 'mastodon':
                    window.open('http://sharetomastodon.github.io/?url=' + url + '&title=Random%20Cute%20Girls%20Programming','rcgpshare','location=no,links=no,scrollbars=no,toolbar=no,width=620,height=550');
                    break;

                default:
                    break;
            }
        }
    }
}
</script>

<style lang="scss">
img {
    max-width: 100%;
}
</style>
