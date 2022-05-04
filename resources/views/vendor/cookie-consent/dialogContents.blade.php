<div class="js-cookie-consent cookie-consent fixed bottom-0 bg-secondary">
    <div class="container">
        <div class="p-2 rounded-lg bg-yellow-100">
            <div class="d-flex flex-row d-flex justify-content-between flex-wrap">
                <div class="mt-auto">
                    <p class="cookie-consent__message mb-1 text-white">
                        {!! trans('cookie-consent::texts.message') !!}
                    </p>
                </div>
                <div class="my-auto">
                    <button class="js-cookie-consent-agree cookie-consent__agree px-4 py-2 btn btn-success text-white fw-bold">
                        {{ trans('cookie-consent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
