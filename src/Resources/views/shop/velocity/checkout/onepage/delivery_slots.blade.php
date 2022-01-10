<div class="control-group mt-20">
    <div v-for="slots, sellerId in sellersTimeSlots" class="mt-20">
        <div class="table">
            <div class="seller-name mb-20" v-if="sellerId == 0 && ! slots.SlotsNotAvilable" >
                <span>{{ __('delivery-time-slot::app.shop.checkout.seller')}}:</span>
                <span>{{ __('delivery-time-slot::app.shop.checkout.admin')}}</span>
            </div>

            <div class="seller-name mb-20" v-if="sellerId == 0 && slots.SlotsNotAvilable" >
                <span>{{ __('delivery-time-slot::app.shop.checkout.seller')}}:</span>
                <span>@{{ slots.seller }}</span>
            </div>

            <table class="radio-boxed">
                <thead>
                    <tr>
                        <th align= "center">Date/Day</th>
                        <th colspan="2" align= "center" style="border-left: 1px solid white;">Delivery Time Slots</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-if="slots.SlotsNotAvilable" >
                        <td colspan="1">
                            <span  class="message" style="font-weight: 700; color: red;">
                                @{{ slots.message }}
                            </span>
                        </td>
                    </tr>
                    <tr v-for="timeSlots, index in slots.days">
                        <td style="text-transform:capitalize;" v-if="index != 'seller'">
                            @{{ index }}
                        </td>

                        <td class="timeslot-td" align="center" style="display: grid;">
                            <span v-for="timeSlot, key in timeSlots" style="box-shadow: 0px 1px 4px 0px;
                            padding: 3px; ">
                                <span v-for="quota, quotaKey in slots.quotas" v-if="quotaKey == timeSlot.id && timeSlot.time_delivery_quota > quota && (Date.parse(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date().getDay()] + ', '+new Date().getDate() + ' ' + (['','January', 'February', 'March', 'April', 'May', 'June',
                                    'July', 'August', 'September', 'October', 'November', 'December'
                                  ][new Date().getMonth()+1])+', '+new Date().getFullYear() +' '+ new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }))) < Date.parse(index.split(' ')[2] + ' ' + index.split(' ')[0] + ' ' + index.split(' ')[1] + ' ' + index.split(' ')[3] +' '+ timeSlot.start_time)" style="padding: 3px;">
                                    <input type="radio" @change="methodSelectedTimeSlot($event)" @change="methodSelected()" :id="timeSlot.id+'_'+sellerId" :name="'start_time_slot_'+sellerId" :value="[timeSlot.id, sellerId, index.split(' ')[2] + ' ' + index.split(' ')[0] + ' ' + index.split(' ')[1] + ' ' + index.split(' ')[3]]" style="margin-top: 9px;">
                                    <label :for="timeSlot.id+'_'+sellerId">
                                        @{{ timeSlot.start_time }} - @{{ timeSlot.end_time }}
                                    </label>
                                </span>

                                <span v-if="(Date.parse(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][new Date().getDay()] + ', '+new Date().getDate() + ' ' + (['','January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November', 'December'
                              ][new Date().getMonth()+1])+', '+new Date().getFullYear() +' '+ new Date().toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true }))) > (Date.parse(index.split(' ')[2] + ' ' + index.split(' ')[0] + ' ' + index.split(' ')[1] + ' ' + index.split(' ')[3] +' '+ timeSlot.start_time))" style="padding: 10px;">
                                    <label :for="timeSlot.id+'_'+sellerId" style="background-color:#fba0a0;" >
                                        @{{ timeSlot.start_time }} - @{{ timeSlot.end_time }}
                                    </label>
                                </span>

                                <span v-for="quota, quotaKey in slots.quotas" v-if="quotaKey == timeSlot.id && timeSlot.time_delivery_quota <= quota" style="padding: 10px;">
                                    <label :for="timeSlot.id+'_'+sellerId" style="background-color:#fba0a0;" >
                                        @{{ timeSlot.start_time }} - @{{ timeSlot.end_time }}
                                    </label>
                                </span>
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>