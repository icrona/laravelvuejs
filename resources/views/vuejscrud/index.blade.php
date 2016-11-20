@extends('app')
@section('content')
  <div class="form-group row add">
    <div class="col-md-12">
      <h1>Simple Laravel Vue.Js Crud</h1>
    </div>
    <div class="col-md-12">
      <button type="button" data-toggle="modal" data-target="#create-item" class="btn btn-primary" >
        Create New Post
      </button>
    </div>
    <div class="col-md-6">
      <div class="input-group custom-search-form">
        <input @keyup="searchVueItems()" type="text" name="search" v-model="search" class="form-control" placeholder="Search ....">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="table-responsive">
      <table class="table table-borderless">
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
        
        <tr v-for="item in items">
          <td>@{{ item.title }}</td>
          <td>@{{ item.description }}</td>
          <td> <input id="checkbox" v-model="item.showns" value="item.showns" @click="clickCheckBox(item)" type="checkbox" ></td>
          <td>
            <button class="edit-modal btn btn-warning" @click.prevent="editItem(item)">
              <span class="glyphicon glyphicon-edit"></span> Edit
            </button>
            <button class="delete-btn delete-modal btn btn-danger" @click.prevent="deleteItem(item)">
              <span class="glyphicon glyphicon-trash"></span> Delete
            </button>
          </td>
        </tr>

      </table>
    </div>
  </div>

  <nav>
    <ul class="pagination">
      <li v-if="pagination.current_page > 1">
        <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
          <span aria-hidden="true">«</span>
        </a>
      </li>
      <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
        <a href="#" @click.prevent="changePage(page)">
          @{{ page }}
        </a>
      </li>
      <li v-if="pagination.current_page < pagination.last_page">
        <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
          <span aria-hidden="true">»</span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Create Item Modal -->
    <!-- Create Item Modal -->
  <div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Create New Post</h4>
        </div>
        <div class="modal-body">
          <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createItem">
            <div class="form-group">
              <label for="title">Title:</label>
              <input type="text" name="title" class="form-control" v-model="newItem.title" />
              <span v-if="formErrors['title']" class="error text-danger">
                @{{ formErrors['title'] }}
              </span>
            </div>
            <div class="form-group">
              <label for="title">Description:</label>
              <textarea name="description" class="form-control" v-model="newItem.description">
              </textarea>
              <span v-if="formErrors['description']" class="error text-danger">
                @{{ formErrors['description'] }}
              </span>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- Edit Item Modal -->
<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Edit Blog Post</h4>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updateItem(fillItem.id)">
          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" v-model="fillItem.title" />
            <span v-if="formErrors['title']" class="error text-danger">
                @{{ formErrors['title'] }}
              </span>
          </div>
          <div class="form-group">
            <label for="title">Description:</label>
            <textarea name="description" class="form-control" v-model="fillItem.description">
            </textarea>
<span v-if="formErrors['description']" class="error text-danger">
                @{{ formErrors['description'] }}
              </span>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
  <script type="text/javascript" src="/js/sweetalert.min.js"></script>
  <script type="text/javascript">
        $('.delete-btn').on('click', function(e){
            swal({
              title: "Are you sure?",
              text: "You will not be able to recover this imaginary file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){
              swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });
    </script>                    
</div>
@stop