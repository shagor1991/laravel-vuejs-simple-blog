import HomeComponent from './components/Home'
import CategoryAdd from './components/category/CategoryAdd'
import CategoryList from './components/category/CategoryList'
import CategoryEdit from './components/category/CategoryEdit'
import PostList from './components/post/PostList'
import PostAdd from './components/post/PostAdd'
import PostEdit from './components/post/PostEdit'

export const routes = [
    { path: '/home', component: HomeComponent },
    { path: '/category', component: CategoryList },    
    { path: '/category/create', component: CategoryAdd },
    { path: '/category/:id', component: CategoryEdit },
    { path: '/post', component: PostList },
    { path: '/post/create', component: PostAdd },
    { path: '/post/:id', component: PostEdit }
  ]
  