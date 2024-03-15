<div x-data="{ showSortFilter: false }">
    <button @click="showSortFilter='true'" class="u-t-gray-dark u-fw-b u-btn u-bg-white u-mr-5" style="min-width: 10rem" type="button" id="export"><i class="fa-solid fa-filter"></i> Sort & Filter</button>

    <div class="modal-center" x-show="showSortFilter" style="display: none;">
        <div class="modal-box" style="max-width: 70rem;">
            <div class="modal-content">
                <form wire:submit="filteredData">
                    <table class="custom_normal_table">
                        <tbody>
                            <tr>
                                <td>
                                    <h4><i class="fa-solid fa-filter"></i> Sort & Filter</h>
                                </td>
                            </tr>
                            @foreach ($sort_filter_columns as $column)
                                <tr>
                                    <td>
                                        <div class="u-flex u-flex-wrap u-align-items-center ">
                                            <span class="u-ml-10 flex-2">{{ ucwords(str_replace('_', ' ', $column)) }}</span>
                                            <select class="u-input flex-2 u-ml-10 u-mr-10" wire:model="filter_column.{{ $column }}" id="">
                                                <option disabled>Filter...</option>
                                                @foreach ($filters as $key => $value)
                                                    <option value="{{ $value }}">{{ ucfirst(str_replace('_', ' ', $key)) }}</option>
                                                @endforeach
                                            </select>
                                            <input class="u-input flex-1 u-ml-10 u-mr-10" wire:model="input_column.{{ $column }}" type="text">
                                            <select class="u-input flex-2 u-ml-10 u-mr-10" wire:model="sort_column.{{ $column }}" id="">
                                                <option value="" selected disabled>Sorting...</option>
                                                @foreach ($sorts as $sort)
                                                    <option value="{{ $sort }}">{{ strtoupper(str_replace('_', ' ', $sort)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="u-flex-space-between u-ml-10 u-mr-10">
                        <button @click="showSortFilter=false;" class="u-t-gray-dark u-fw-b u-btn u-bg-default u-m-10 u-border-1-default" type="button"">Close</button>
                        <button class="u-t-white u-fw-b u-btn u-bg-primary u-m-10 u-border-1-default" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
