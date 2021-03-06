<div class="form-group row">
    <label class="col-lg-3 col-form-label" for="categoryLevel">Select Catgeory Level<span class="text-danger">*</span></label>
    <div class="col-lg-6">
        <select class="form-control" id="categoryLevel" name="parent_id">
            <option value="0"
                @if(isset($categorydata['parent_id']) && $categorydata['parent_id'] == 0) selected="" @endif>
                    Main Category
            </option>
            @if (!empty($getCategories))
                @foreach ($getCategories as $category)
                    <option value=" {{$category['id']}} " 
                        @if(isset($categorydata['parent_id']) && $categorydata['parent_id'] == $category['id']) selected="" @endif> 
                        {{$category['category_name']}} 
                    </option>
                        
                        @if (!empty($category['sub_categories']))
                            @foreach ($category['sub_categories'] as $subCategory)
                                <option value=" {{$subCategory['id']}} " >&nbsp;&raquo;&nbsp;{{$subCategory['category_name']}} </option>
                            @endforeach     
                        @endif
                @endforeach     
            @endif
        </select>
    </div>
</div>