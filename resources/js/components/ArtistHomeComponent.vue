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
                <div class="mb-4-cutom"  v-for="photoUser in getUserArtistListPhotographer" :key="photoUser.id">
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
                <div class="mb-4-cutom"  v-for="animatorUser in getUserArtistListAnimator" :key="animatorUser.id">
                    <div class="choose-photographer-box" style="margin:10px;">
                        <div class="header-photographer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img :src="baUrl + '/public/avatar/' + animatorUser.avatar" alt="" class="set-img-size" style="width:100px;">
                                </div>
                                <div class="col-sm-7 offset-md-1">
                                    <h4 class="title-this">{{ animatorUser.username }}</h4>
                                        <p class="tag-one">{{ animatorUser.type_name }}</p>
                                    
                                    <!-- <p class="tag-two">Available</p> -->
                                </div>
                            </div>
                        </div>    
                                
                        <div class="bottom" v-if="animatorUser.type_name == 'Photographer'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/thumbnail/' + animatorUser.img +')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ animatorUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ animatorUser.id +'&cityId=' + animatorUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(animatorUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bottom" v-else-if="animatorUser.type_name == 'Videographer'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/video/screen_shot/' + animatorUser.ScreenShot +')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ animatorUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ animatorUser.id +'&cityId=' + animatorUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(animatorUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        <div class="bottom" v-else-if="animatorUser.type_name == 'Animator'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/video/screen_shot/' + animatorUser.ScreenShot +')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ animatorUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ animatorUser.id +'&cityId=' + animatorUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(animatorUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        <div class="bottom" v-else-if="animatorUser.type_name == 'Musician'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/thumbnail/musicWave.png'+')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ animatorUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ animatorUser.id +'&cityId=' + animatorUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(animatorUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div> 
                <div class="mb-4-cutom"  v-for="videoUser in getUserArtistListVideographer" :key="videoUser.id">
                    <div class="choose-photographer-box" style="margin:10px;">
                        <div class="header-photographer">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img :src="baUrl + '/public/avatar/' + videoUser.avatar" alt="" class="set-img-size" style="width:100px;">
                                </div>
                                <div class="col-sm-7 offset-md-1">
                                    <h4 class="title-this">{{ videoUser.username }}</h4>
                                        <p class="tag-one">{{ videoUser.type_name }}</p>
                                    
                                    <!-- <p class="tag-two">Available</p> -->
                                </div>
                            </div>
                        </div>    
                                
                        <div class="bottom" v-if="videoUser.type_name == 'Photographer'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/thumbnail/' + videoUser.img +')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ videoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ videoUser.id +'&cityId=' + videoUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(videoUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bottom" v-else-if="videoUser.type_name == 'Videographer'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/video/screen_shot/' + videoUser.ScreenShot +')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ videoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ videoUser.id +'&cityId=' + videoUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(videoUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        <div class="bottom" v-else-if="videoUser.type_name == 'Animator'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/video/screen_shot/' + videoUser.ScreenShot +')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ videoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ videoUser.id +'&cityId=' + videoUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''"  @click="addToActiveChat(videoUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                        <div class="bottom" v-else-if="videoUser.type_name == 'Musician'" :style="{backgroundImage: 'url('+ baUrl + '/public/uploads/thumbnail/musicWave.png'+')'}">
                            <div class="row">
                                <div class="col-5 offset-7">
                                    <a :href="baUrl +'/artist/'+ videoUser.id" class="btn-portfolio-one mb-2">Portfolio</a>
                                    <a :href="baUrl +'/request-to-book?photographerId='+ videoUser.id +'&cityId=' + videoUser.city_id" class="button-book-one mb-2">Book artist</a>
                                    <a href="javascript:;" v-if="suser != ''" @click="addToActiveChat(videoUser)" class="button-chat-two" >Chat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            <!-- <div class="photographer-box "  v-for="photoUser in getUserArtistListPhotographer" :key="photoUser.id" >
                <div class="photographer-img">
                    <img alt="" class="img-fluid" style="height: 260px" src="http://projects.hexawebstudio.com/darquise-nantel/public/cover/cover.jpg">
                </div>
                <div class="d-flex">
                    <div class="align-self-center">
                        <a href="javascript:;"  @click="addToActiveChat(photoUser)" class="btn-chat">Let's Chat </a>
                    </div>
                    <div class="photographer-person-img text-center ml-5"><img style="border-radius: 50%;width: 140px;" alt="" :src="baUrl +'/public/avatar/'+ photoUser.avatar"></div>
                    <div class="icon-photo">
                        <i class="far fa-images"></i> <small class="photos-count">{{ photoUser.id }}</small>
                    </div>
                </div>
                <div class="d-flex photographer-info">
                    <div class="">
                        <h2 class="photographer-name">{{ photoUser.username }}</h2><small>{{ photoUser.type_name }}</small>
                    </div>
                    <div class="ml-auto mt-4">
                        <a class="btn-hire-me" href="javascript:;">hire me </a>
                    </div>
                </div>
            </div>
            <div class="photographer-box " v-for="videoUser in getUserArtistListAnimator" :key="videoUser.id">
                <div class="">
                    <div class="photographer-img">
                        <img alt="" class="img-fluid" style="height: 260px" src="http://projects.hexawebstudio.com/darquise-nantel/public/cover/cover.jpg">
                    </div>
                    <div class="d-flex">
                        <div class="align-self-center">
                            <a href="javascript:;"  @click="addToActiveChat(videoUser)" class="btn-chat">Let's Chat</a>
                        </div>
                        <div class="photographer-person-img text-center ml-5"><img style="border-radius: 50%;width: 140px;" alt="" :src="baUrl +'/public/avatar/'+ videoUser.avatar"></div>
                        <div class="icon-photo">
                            <i class="far fa-images"></i> <small class="photos-count">{{ videoUser.id }}</small>
                        </div>
                    </div>
                    <div class="d-flex photographer-info">
                        <div class="">
                            <h2 class="photographer-name" v-if="videoUser.name !=''">{{ videoUser.name }}</h2><h2 class="photographer-name" v-else>{{ videoUser.username }}</h2><small>{{ videoUser.type_name }}</small>
                        </div>
                        <div class="ml-auto mt-4">
                            <a class="btn-hire-me" href="javascript:;">hire me</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="photographer-box " v-for="videoUser in getUserArtistListVideographer" :key="videoUser.id">
                <div class="">
                    <div class="photographer-img">
                        <img alt="" class="img-fluid" style="height: 260px" src="http://projects.hexawebstudio.com/darquise-nantel/public/cover/cover.jpg">
                    </div>
                <div class="d-flex">
                        <div class="align-self-center">
                            <a href="javascript:;"  @click="addToActiveChat(videoUser)" class="btn-chat">Let's Chat</a>
                        </div>
                        <div class="photographer-person-img text-center ml-5"><img style="border-radius: 50%;width: 140px;" alt="" :src="baUrl +'/public/avatar/'+ videoUser.avatar"></div>
                        <div class="icon-photo">
                            <i class="far fa-images"></i> <small class="photos-count">{{ videoUser.id }}</small>
                        </div>
                    </div>
                    <div class="d-flex photographer-info">
                        <div class="">
                            <h2 class="photographer-name" v-if="videoUser.name !=''">{{ videoUser.name }}</h2><h2 class="photographer-name" v-else>{{ videoUser.username }}</h2><small>{{ videoUser.type_name }}</small>
                        </div>
                        <div class="ml-auto mt-4">
                            <a class="btn-hire-me" href="javascript:;">hire me</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="photographer-box " v-for="musicUser in getUserArtistListMusician" :key="musicUser.id">
                <div class="">
                    <div class="photographer-img">
                        <img alt="" class="img-fluid" style="height: 260px" src="http://projects.hexawebstudio.com/darquise-nantel/public/cover/cover.jpg">
                    </div>
                    <div class="d-flex">
                        <div class="align-self-center">
                            <a href="javascript:;"  @click="addToActiveChat(musicUser)" class="btn-chat">Let's Chat</a>
                        </div>
                        <div class="photographer-person-img text-center ml-5"><img style="border-radius: 50%;width: 140px;" alt="" :src="baUrl +'/public/avatar/'+ musicUser.avatar"></div>
                        <div class="icon-photo">
                            <i class="far fa-images"></i> <small class="photos-count">{{ musicUser.id }}</small>
                        </div>
                    </div>
                    <div class="d-flex photographer-info">
                        <div class="">
                            <h2 class="photographer-name" v-if="musicUser.name !=''">{{ musicUser.name }}</h2><h2 class="photographer-name" v-else>{{ musicUser.username }}</h2><small>{{ musicUser.type_name }}</small>
                        </div>
                        <div class="ml-auto mt-4">
                            <a class="btn-hire-me" href="javascript:;">hire me</a>
                        </div>
                    </div>
                </div>
            </div> -->
        </carousel>
            </div>

    </div>
</template>
<script>
import carousel from "vue-owl-carousel";

    // var loaded = false;
    export default {
       
        components: {
            carousel
        },
        name: "MyComponent",
        props: {
            bUrl:{
                type: String
            },
            msg: String,
            sessionuser : String
        },
        data() {
            return {
                collapsed: false,
                users: [],
                getUserArtistListPhotographer: [],
                getUserArtistListAnimator: [],
                getUserArtistListVideographer: [],
                getUserArtistListMusician: [],
                loaded : false,
                baUrl : window.axios.defaults.baseURL,
                suser : this.sessionuser
            }
        },
        //  mounted () {
        //      this.runCarousel();
            
        // },
        async created() {
            const {data} = await axios.get('/get-users-all');
            // console.log(data);
            this.getUserArtistListPhotographer = data.getUserArtistListPhotographer;
            
            console.log(this.getUserArtistListPhotographer);
            this.getUserArtistListAnimator = data.getUserArtistListAnimator;
            console.log(this.getUserArtistListAnimator);
            this.getUserArtistListVideographer = data.getUserArtistListVideographer;
            console.log(this.getUserArtistListVideographer);
            this.getUserArtistListMusician = data.getUserArtistListMusician;
            console.log(this.getUserArtistListMusician);
            if(this.getUserArtistListPhotographer !== null) {
                this.loaded = true;
            }
        },
        methods: {
            // runCarousel(){
            //     console.log('mounted');
            //     console.log(this.getUserArtistListPhotographer, this.loaded);
                
            // },
            addToActiveChat(datas) {

    //             console.log('asdas')
    //             console.log(photoUser);
    //             console.log(videoUser);
    //             if(photoUser){
    // console.log('in if');
                    this.EventBus.$emit('newActiveChat', datas)
                // }else if(videoUser){
                //     console.log('in else if ');
                //     this.EventBus.$emit('newActiveChat', videoUser)
                // }
            }
        }
    };

    
</script>

<!-- <script>
// import VueSlickCarousel from '@bit/gsshop.vue-slick-carousel.vue-slick-carousel';
import VueSlickCarousel from 'vue-slick-carousel';
  import 'vue-slick-carousel/dist/vue-slick-carousel.css';
  // optional style for arrows & dots
  import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css';

	// import '@bit/gsshop.vue-slick-carousel.vue-slick-carousel-theme';


export default {
    name: 'MyComponent',
    components: { VueSlickCarousel },
    props: ['messages', 'userId'],
    data() {
        return {

            settings: {
          arrows: true,
          dots: true,
        },
            collapsed: false,
            users: [],
            getUserArtistListPhotographer: [],
            getUserArtistListAnimator: [],
            getUserArtistListVideographer: [],
            getUserArtistListMusician: [],
        }
    },
    async created() {
        const {data} = await axios.get('/darquise_nantel/get-users-all');
        this.getUserArtistListPhotographer = data.getUserArtistListPhotographer;
        console.log(this.getUserArtistListPhotographer);
        this.getUserArtistListAnimator = data.getUserArtistListAnimator;
        console.log(this.getUserArtistListAnimator);
        this.getUserArtistListVideographer = data.getUserArtistListVideographer;
        console.log(this.getUserArtistListVideographer);
        this.getUserArtistListMusician = data.getUserArtistListMusician;
        console.log(this.getUserArtistListMusician);
    },
    methods: {
        addToActiveChat(datas) {

//             console.log('asdas')
//             console.log(photoUser);
//             console.log(videoUser);
//             if(photoUser){
// console.log('in if');
                this.EventBus.$emit('newActiveChat', datas)
            // }else if(videoUser){
            //     console.log('in else if ');
            //     this.EventBus.$emit('newActiveChat', videoUser)
            // }
        }
    }
    
}

</script> -->