<tr>
    <td class="dt-type-numeric">
    </td>
    <td class="inline-select-config-data-row"><select class="form-control inline-select-configs" name="config_type_add" id="configTypeAdd">
            <option value="selectType">-- Select Type --</option>
            <option id="createNewType" value="createNewType">Create New Type</option>
            @foreach($configTypes as $k=> $configType)
            <option value="{{$configType->type}}">{{$configType->type}}</option>
            @endforeach
        </select></td>
    <td><span class="form-control"><input style="border: none;" type="text" name="config_name_add"></span></td>
    <td class="dt-type-numeric"><input class="form-control" name="config_value_add" type="number"></td>
    <td><select class="form-control inline-select-configs" name="config_status_add" id="configStatusAdd">
            <option data-config-status="1" value="1">Active</option>
            <option data-config-status="0" value="0">Inactive</option>
        </select></td>
    <td>
        <button id="saveNewConfig" class="btn btn-sm btn-primary inline-editing-common"><i class="fa fa-check" aria-hidden="true"></i></button>
        <button id="cancelNewConfig" class="btn btn-sm btn-danger inline-editing-common"><i class="fa fa-times" aria-hidden="true"></i></button>
        <!-- <button id="cancelNewConfig"><i class="fa fa-times" aria-hidden="true"></i></button> -->
    </td>
</tr>