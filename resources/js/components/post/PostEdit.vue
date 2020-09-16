<template>
  <div>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Post Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Post</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Post edit form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" @submit.prevent="post_update">
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" v-model="form.title" class="form-control" :class="{ 'is-invalid': form.errors.has('title') }" placeholder="Title">
                    <has-error :form="form" field="title"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="body">Body</label>
                    <!-- <textarea name="" class="form-control"cols="30" rows="10"></textarea> -->
                    <markdown-editor v-model="form.body"></markdown-editor>

                    <has-error :form="form" field="body"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="category_name">Category</label>
                    <select class="form-control" v-model="form.category_id">
                      <option>Select Option</option>
                      <option v-for="category in all_category" :key="category.id" :value="category.id"> {{category.name}}</option>

                    </select>
                    <has-error :form="form" field="category"></has-error>
                  </div>

                  <div class="form-group">
                    <label for="category_name">Photo</label>
                    <input type="file" @change="printFile($event)" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }" placeholder="Category Name">
                    <has-error :form="form" field="name"></has-error>
                    <img :src="showPhoto" width="300" height="200">
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
    name: "PostAdd",
    data(){
      return {
        form: new Form({
          title: '',
          body: '',
          category_id: '',
          photo: ''
        })
      }
    },
    mounted(){
      this.$store.dispatch('get_category')
    },
    computed:{
      all_category(){
        return this.$store.getters.get_all_category
      },
      showPhoto(){
        if(this.form.photo.length >1000){
          return this.form.photo
        }else{
          return 'uploads/images/'+this.form.photo
        }
      }
    },
    created(){
        axios.get('/post/'+ this.$route.params.id)
        .then((response)=>{
            this.form.fill(response.data.post)
        })
        .catch((error)=>{
            console.log(error)
        })
    },
    methods:{
      post_update(){
        this.form.post('/post/'+ this.$route.params.id)
        .then((response)=>{
          this.$router.push('/post')
          Toast.fire({
            icon: 'success',
            title: 'Updated successfully!'
          })
          console.log(response)
        })
      },
      printFile(event){
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = (event)=> {
          // The file's text will be printed here
          console.log(event.target.result)
          this.form.photo= event.target.result
        };

        reader.readAsDataURL(file);
      }
    }
}
</script>

<style>

</style>