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
        <div class="ui grid">
            <div class="three column row" v-for="image in images">
                <div class="left floated left aligned column">
                    <img :src="'/storage/' + image.path" class="ui fluid image">
                </div>
                <div class="center aligned middle aligned column">
                    <h3 class="ui header">
                        <div class="content">
                            {{ image.name }}
                            <div class="sub header">{{ image.src }}</div>
                        </div>
                    </h3>
                </div>
                <div class="right floated right aligned middle aligned column">
                    <a class="ui red labeled icon button" href="#" @click.prevent="deleteImage(image.id)"><i class="remove icon"></i> Delete</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="ui grid">
            <div class="two column row">
                <div class="left floated left aligned column">
                    <div class="ui pagination menu">
                        <a class="item" @click.prevent="switchPage(-1)">
                            <i class="arrow circle left icon"></i> Previous
                        </a>
                        <div class="disabled item">
                            {{ page }}
                        </div>
                        <a class="item" @click.prevent="switchPage(1)">
                            Next <i class="arrow circle right icon"></i>
                        </a>
                    </div>
                </div>

                <div class="right floated right aligned middle aligned column">
                    <form @submit.prevent="getImages()">
                        <div class="ui labeled input">
                            <div class="ui label">
                                Results per page
                            </div>
                            <input type="text" placeholder="5" v-model="epp">
                        </div>
                    </form>
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
            images: [],
            page: 1,
            epp: 5,
            user: {ok: false, name: ''}
        }
    },

    methods: {
        getImages() {
            axios.get('/api/images', {
                params: {
                    page: this.page,
                    epp: this.epp ? this.epp:5 // Fallback to default if no input
                }
            }).then(res => {
                this.images = res.data.results;
            });
        },
        switchPage(nb) {
            if (this.page + nb <= 0) {
                return;
            } else {
                this.page = this.page + nb;
            }
            this.getImages();
        },
        deleteImage(imgid) {
            axios.delete('/api/image/'+imgid).then(res => {
                if (res.data == 'ok') {
                    this.getImages();
                    new Noty({
                        type: 'success',
                        layout: 'topRight',
                        theme: 'metroui',
                        timeout: 2500,
                        text: '<i class="check icon"></i> Deleted!'
                    }).show();
                } else {
                    new Noty({
                        type: 'error',
                        layout: 'topRight',
                        theme: 'metroui',
                        timeout: 2500,
                        text: '<i class="exclamation triangle icon"></i> Cannot delete image, are you logged in?'
                    }).show();
                }
            });
        }
    },

    mounted() {
        axios.get('/api/statistics').then(res => {
            this.data = res.data;
        });
        axios.get('/api/loggedin').then(res => {
            this.user = res.data;
        });
        this.getImages();
    }
}
</script>
