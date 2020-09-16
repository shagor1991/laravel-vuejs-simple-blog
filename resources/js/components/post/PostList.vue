<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Post List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Post</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
                <div class="card-tools">                    
                    <button class="btn btn-primary">
                        <router-link to="/Post/create" style="color:#fff000;">Add Post</router-link>
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">SL No.</th>
                      <th>Username</th>
                      <th>Category name</th>
                      <th>Title</th>
                      <th>Body</th>
                      <th>Photo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(post,index) in all_post">
                      <td>{{index+1}}</td>
                      <td v-if="post.user">{{post.user.name}}</td>
                      <td v-if="post.category">{{post.category.name}}</td>
                      <td v-else></td>
                      <td>{{post.title}}</td>
                      <td>{{post.body}}</td>
                      <td><img :src="`uploads/images/${post.photo}`" width="150" height="150"></td>
                      <td>
                          <router-link :to="`/post/${post.id}`" class="btn btn-primary">Edit</router-link>
                          <a @click.prevent="deletePost(post.id)" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
export default {
    name: "PostList",
    mounted(){
      this.$store.dispatch('get_posts')
    },
    computed:{
      all_post(){
        return this.$store.getters.get_all_post
      }
    },
    methods:{
      deletePost(id){
        axios.get('/post-delete/'+ id)
        .then((response)=>{
          console.log(response)
          this.$store.dispatch('get_posts')
          Toast.fire({
            icon: 'warning',
            title: 'Post Deleted!'
          })
        })
        .catch((error)=>{
          console.log(error)
        })
      }
    }
}
</script>

<style>

</style>