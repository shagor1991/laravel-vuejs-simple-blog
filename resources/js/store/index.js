import Axios from "axios"

export default{
    state:{
        categories: [],
        posts: []
    },
    getters:{
        get_all_category(state){
            return state.categories
        },
        get_all_post(state){
            return state.posts
        }
    },
    mutations:{
        all_category(state,data){
            state.categories= data
        },
        all_post(state,data){
            state.posts= data
        }
    },
    actions:{
        get_category(context){
            Axios.get('category-list')
            .then((response)=>{
                context.commit('all_category',response.data.categories)
            })
        },
        get_posts(context){
            Axios.get('/posts')
            .then((response)=>{
                context.commit('all_post',response.data.posts)
            })
        }
    }
}