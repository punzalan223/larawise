<div class="u-mt-10" x-data="{ showModalAddUser: false, showModalEditUser: false, showModalViewUser: false }">
    <div class="u-flex-space-between u-flex-wrap u-mt-16 u-mb-16">
        <div class="u-flex-alignIt-center">
            <select class="u-btn u-box-shadow-default u-mr-5" wire:model="paginate" wire:change="$set('paginate', $event.target.value)">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="500">500</option>
                <option value="1000">1000</option>
            </select>
        </div>
        <input class="u-input" style="max-width: 15.635rem;" wire:model.live="search" type="text" placeholder="Search">
    </div>
    <div style="overflow-x: auto; border-radius: 0.5rem; box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
        <table class="u-responsive-table">
            <tr class="u-fw-b">
                <td>IP address</td>
                <td>Useragent</td>
                <td>Description</td>
                <td>User</td>
                <td>Created At</td>
            </tr>
            @foreach ($user_logs as $user_log)
                <tr class="u-t-gray">
                    <td>{{ $user_log->ip_address }}</td>
                    <td>{{ $user_log->useragent }}</td>
                    <td>{{ $user_log->description }}</td>
                    <td>{{ $user_log->created_by }}</td>
                    <td>{{ $user_log->created_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    
    <div class="u-flex-space-between u-flex-wrap u-mt-10">
        {{ $user_logs->links('livewire::default') }}
        <div class="u-flex-alignIt-center">
            <h5 :class="(darkMode ? 'u-t-white' : '')">
                Showing record(s) :
                {{ $user_logs->firstItem() }} to {{ $user_logs->lastItem() }} of {{ $user_logs->total() }}
            </h5>
        </div>
    </div>

</div>
