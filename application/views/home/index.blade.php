@layout('master')

@section('content')
    <?php
    /** @var EstateList $estateList */
    ?>
    {{ Form::open(\Laravel\URL::to(__("route.notification_save")), 'POST') }}
    {{ Form::token() }}

    <div class="row margin-top-10">
        <div class="col-md-12">
                <textarea class="form-control" name="message" rows="4"
                          placeholder="Gönderilecek Mesaj Metni"></textarea>
        </div>
    </div>
    <div class="row margin-top-10">
        <div class="col-md-12">
            <select class="form-control" name="remoteEstateID">
                <option value="0">Açılacak Emlak Detayı (Opsiyonel)</option>
                <?php foreach($estateList->items as $item): ?>
                <option value="<?php echo $item->AdBaseId ?>"><?php echo $item->getInfo(); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="row margin-top-10">
        <div class="col-md-12">
            <input type="button" class="btn btn-primary btn-lg btn-block"
                   value="<?php echo __('common.push_notify_send')?>"
                   onclick="sCommon.save(route['notification_save'])">
        </div>
    </div>

    {{Form::close()}}
@endsection
