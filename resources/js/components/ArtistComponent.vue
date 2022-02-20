<template>

    <div class="row margin-top-destination-location-box">
        <div class="col-md-4 mb-4-cutom"  v-for="photoUser in getUserArtistList" :key="photoUser.id">
            <div class="choose-photographer-box">
                <div class="header-photographer">
                    <div class="row">
                        <div class="col-sm-4">
                            <img :src="baUrl + '/avatar/' + photoUser.avatar" alt="" class="set-img-size">
                        </div>
                        <div class="col-sm-7 offset-md-1">
                            <h4 class="title-this">{{ photoUser.username }}</h4>
                                <p class="tag-one">{{ photoUser.type_name }}</p>

                            <!-- <p class="tag-two">Available</p> -->
                        </div>
                    </div>
                </div>

                <div class="bottom" v-if="photoUser.type_name == 'Photographer'" :style="{backgroundImage: 'url('+ baUrl + '/uploads/thumbnail/' + photoUser.img +')'}">
                    <div class="row">
                        <div class="col-5 offset-7">
                            <a :href="baUrl +'/artist/'+ photoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                            <a :href="baUrl +'/request-to-book?photographerId='+ photoUser.id +'&cityId=' + photoUser.city_id" class="button-book-one mb-2">Book artist</a>
                            <a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>
                        </div>
                    </div>
                </div>

                <div class="bottom" v-else-if="photoUser.type_name == 'Videographer'" :style="{backgroundImage: 'url('+ baUrl + '/uploads/video/screen_shot/' + photoUser.ScreenShot +')'}">
                    <div class="row">
                        <div class="col-5 offset-7">
                            <a :href="baUrl +'/artist/'+ photoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                            <a :href="baUrl +'/request-to-book?photographerId='+ photoUser.id +'&cityId=' + photoUser.city_id" class="button-book-one mb-2">Book artist</a>
                            <a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>
                        </div>
                    </div>
                </div>
                <div class="bottom" v-else-if="photoUser.type_name == 'Animator'" :style="{backgroundImage: 'url('+ baUrl + '/uploads/video/screen_shot/' + photoUser.ScreenShot +')'}">
                    <div class="row">
                        <div class="col-5 offset-7">
                            <a :href="baUrl +'/artist/'+ photoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                            <a :href="baUrl +'/request-to-book?photographerId='+ photoUser.id +'&cityId=' + photoUser.city_id" class="button-book-one mb-2">Book artist</a>
                            <a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>
                        </div>
                    </div>
                </div>
                <div class="bottom" v-else-if="photoUser.type_name == 'Musician'" :style="{backgroundImage: 'url('+ baUrl + '/uploads/thumbnail/musicWave.png'+')'}">
                    <div class="row">
                        <div class="col-5 offset-7">
                            <a :href="baUrl +'/artist/'+ photoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                            <a :href="baUrl +'/request-to-book?photographerId='+ photoUser.id +'&cityId=' + photoUser.city_id" class="button-book-one mb-2">Book artist</a>
                            <a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>

// export default {
//         props: ['user'],
//         data(){
//             return {

//             }
//         },
//         mounted() {
//             console.log(this.user)
//         }
//     }

    export default {

        name: "ArtistCard",
        props:['cityslug', 'sessionuser', 'cityroute'],
        data() {
            return {
                collapsed: false,
                users: [],
                getUserArtistList: [],
                loaded : false,
                baUrl : window.axios.defaults.baseURL,
                suser : this.sessionuser
            }
        },
        async created() {

            if(this.cityslug != ""){
                watch: {
                    const {data} = await axios.get('/get-users-by-city-route/'+this.cityslug+'/'+this.cityroute);
                    this.getUserArtistList = data.getUserArtistList;
                }
            }else{
                watch: {
                    const {data} = await axios.get('/get-users-all');
                    this.getUserArtistList = data.getUserArtistList;
                }
            }
        },
        methods: {
            addToActiveChat(datas) {
                this.EventBus.$emit('newActiveChat', datas)
            }
        }
    };


</script>

