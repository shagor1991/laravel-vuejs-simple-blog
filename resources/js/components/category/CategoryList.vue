<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
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
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
                <div class="card-tools">                    
                    <button class="btn btn-primary">
                        <router-link to="/category/create" style="color:#fff000;">Add Category</router-link>
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">SL No.</th>
                      <th>Category Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(category,index) in all_category">
                      <td>{{index+1}}</td>
                      <td>{{category.name}}</td>
                      <td>
                          <router-link :to="`/category/${category.id}`" class="btn btn-primary">Edit</router-link>
                          <a @click.prevent="deleteCategory(category.id)" class="btn btn-danger">Delete</a>
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
    name: "CategoryList",
    mounted(){
      this.$store.dispatch('get_category')
    },
    computed:{
      all_category(){
        return this.$store.getters.get_all_category
      }
    },
    methods:{
      deleteCategory(id){
        axios.get('/category-delete/'+ id)
        .then((response)=>{
          console.log(response)
          this.$store.dispatch('get_category')
          Toast.fire({
            icon: 'error',
            title: 'Category Deleted!'
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