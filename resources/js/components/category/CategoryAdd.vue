<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Category</a></li>
              <li class="breadcrumb-item active">Create</li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Category create form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" @submit.prevent="category_save">
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Category Name">
                    <has-error :form="form" field="name"></has-error>
                  </div> 

                  <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <Select2 :options="options" />
                    <has-error :form="form" field="name"></has-error>
                  </div>                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
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
    name: "CategoryAdd",
    data(){
      return {
        options: [
          'Shagor',
          'Manik',
          'Mainuddin',
          'Tanvir',
          'Usama',
          'Shajib'
        ],
        form: new Form({
          name: ''
        })
      }
    },
    methods:{
      category_save(){
        this.form.post('/category')
        .then((response)=>{
          this.$router.push('/category')
          Toast.fire({
            icon: 'success',
            title: 'Created successfully!'
          })
          console.log(response)
        })
      }
    }
}
</script>

<style>

</style>