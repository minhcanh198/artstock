<style lang="scss" scoped>
    .slick-slider {
        // width: 500px;
        div {
            outline: none;
        }
        h1 {
            text-align: center;
            background-color: #2f3241;
            color: #abe8f6;
            line-height: 100px;
            margin: 3px;
        }
        ::v-deep .slick-arrow:before {
            color: #2f3241;
            opacity: 1;
        }
    }

    .hamzaRightMargin {
        margin-right: 30px;
    }
</style>

<script>
    settings = {
        "dots": true,
        "arrows": true,
        //   "focusOnSelect": true,
        "infinite": false,
        "speed": 1000,
        "slidesToShow": 3,
        "slidesToScroll": 1,
        //   "touchThreshold": 5    
    }
</script>

<template> 

    <div>
        
        <div class="margin-top-destination-location-box">
            <carousel  v-if="loaded" :dots="true" :nav="false" :loop="false" :items="3" >
                <div class="mb-4-cutom"  v-for="photoUser in getUserArtistList" :key="photoUser.id">
                    <div class="choose-photographer-box" style="margin:10px;">
                        <div class="header-photographer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img :src="baUrl + '/public/avatar/' + photoUser.avatar" alt="" class="set-img-size" style="width:100px;">
                                </div>
                                <div class="col-sm-7 offset-md-1">
                                    <h4 class="title-this">{{ photoUser.username }}</h4>
                                        <p class="tag-one">{{ photoUser.type_name }}</p>
                                    
                                    <!-- <p class="tag-two">Available</p> -->
                                </div>
                            </div>
                        </div>    
                                
                        <div class="bottom" v-if="photoUser.type_name == 'Photographer'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/thumbnail/' + photoUser.img +')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ photoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ photoUser.id +'&cityId=' + photoUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bottom" v-else-if="photoUser.type_name == 'Videographer'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/video/screen_shot/' + photoUser.ScreenShot +')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ photoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ photoUser.id +'&cityId=' + photoUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        <div class="bottom" v-else-if="photoUser.type_name == 'Animator'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/video/screen_shot/' + photoUser.ScreenShot +')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ photoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ photoUser.id +'&cityId=' + photoUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(photoUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        <div class="bottom" v-else-if="photoUser.type_name == 'Musician'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/thumbnail/musicWave.png'+')'}">
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
            </carousel>
        </div>
    </div>
</template>
<script>
import carousel from "vue-owl-carousel";

    export default {
       
        components: {
            carousel
        },
        name: "MyComponent",
        props:['categoryslug', 'sessionuser'],

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

            console.log("ye session --====> " + this.sessionuser);
            const {data} = await axios.get('/get-users-by-cate/' + this.categoryslug);
            this.getUserArtistList = data.getUserArtistList;
            console.log(this.getUserArtistList);
            if(this.getUserArtistList !== null) {
                this.loaded = true;
            }
        },
        methods: {
            addToActiveChat(datas) {
                this.EventBus.$emit('newActiveChat', datas);
            }
        }
    };

    
</script>