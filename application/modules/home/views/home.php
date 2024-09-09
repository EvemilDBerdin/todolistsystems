<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Todo-List SYSTEM</h3>
    </div>
    <div class="col-md-7 align-self-center text-right d-none d-md-block">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".long-modal"><i
                class="fa fa-plus-circle"></i> Create</button>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-xlg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <table id="tbl_todo"
                    class="display nowrap table table-hover table-striped table-bordered dataTable" role="grid"
                    aria-describedby="example23_info" style="width: 100%;" width="100%" cellspacing="0">
                    <thead>
                        <tr role="row">
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th> 
                        </tr>
                    </thead> 
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Todo Modal  -->
<div class="modal long-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="longmodal"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="adddepartmentidForm" onsubmit="addTodoForm(event)">
                <div class="modal-header titleModalBg">
                    <h4 class="modal-title text-light font-bold" id="longmodal">
                        Add Todo List
                    </h4>
                </div>
                <div class="modal-body">  
                    <div class="mt-1">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required="required">
                    </div>
                    <div class="mt-1">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" required="required">
                    </div>
                    <div class="mt-1">
                        <label>Due Date</label>
                        <input type="date" class="form-control" name="duedate" required="required">
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect text-left">
                        Save
                    </button>
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Todo Modal  -->
<div class="modal" id="editTodoIdModal" tabindex="-1" role="dialog" aria-labelledby="longmodal"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editdepartmentidForm" onsubmit="editTodoForm(event)">
                <div class="modal-header titleModalBg">
                    <h4 class="modal-title text-light font-bold" id="longmodal">
                        Edit Todo List
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" required="required">
                    <div class="mt-1">
                        <label>Title</label>
                        <input type="text" class="form-control" name="edit[title]" required="required">
                    </div>
                    <div class="mt-1">
                        <label>Description</label>
                        <input type="text" class="form-control" name="edit[description]" required="required">
                    </div>
                    <div class="mt-1">
                        <label>Due Date</label>
                        <input type="date" class="form-control" name="edit[duedate]" required="required">
                    </div>  
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect text-left">
                        Save
                    </button>
                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>