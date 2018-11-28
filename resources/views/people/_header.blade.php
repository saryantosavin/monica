<div class="ph3 ph5-ns pv2 cf w-100 mt4 mt0-ns">

    <div class="mw9 center tc w-100 avatar-header relative">
      {{-- AVATAR --}}
      <div class="relative center dib z-3">
        <div class="relative hide-child">
          <div class="image-header">
            <div class="cover br3 bb b--gray-monica" style="background-image: url('{{ $contact->getAvatarURL() }}'); height: 115px; width: 115px;">
            </div>
          </div>
          <div class="child absolute top-0 left-0 h-100 w-100 br3">
            <div class="db w-100 h-50 center tc pt3">
              <a class="no-underline white" href="">{{ trans('app.zoom') }}</a>
            </div>
            <div class="db w-100 h-50 center tc pt3">
              <a class="no-underline white" href="/people/{{ $contact->hashID() }}/avatar">{{ trans('app.update' )}}</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mw9 center dt w-100 box-shadow pa4 relative">

      <h1 class="tc mb2 mt4">
        <span class="{{ htmldir() == 'ltr' ? 'mr1' : 'ml1' }}">{{ $contact->name }}</span>
        <contact-favorite hash="{{ $contact->hashID() }}" :starred="{{ json_encode($contact->is_starred) }}"></contact-favorite>
      </h1>

      <ul class="tc-ns mb3 {{ htmldir() == 'ltr' ? 'tl' : 'tr' }}">

        {{-- AGE --}}
        <li class="mb2 mb0-ns di-ns db tc {{ htmldir() == 'ltr' ? 'mr3-ns' : 'ml3-ns' }}">
          @if ($contact->birthday_special_date_id && !($contact->is_dead))
            @if ($contact->birthdate->getAge())
              <span class="{{ htmldir() == 'ltr' ? 'mr1' : 'ml1' }}">@include('partials.icons.header_birthday')</span>
              <span>{{ $contact->birthdate->getAge() }}</span>
            @endif
          @elseif ($contact->is_dead)
              @if (! is_null($contact->deceasedDate))
                {{ trans('people.deceased_label_with_date', ['date' => $contact->deceasedDate->toShortString()]) }}
                @if ($contact->deceasedDate->is_year_unknown == 0)
                  <span>({{ trans('people.deceased_age') }} {{ $contact->getAgeAtDeath() }})</span>
                @endif
              @else
                {{ trans('people.deceased_label') }}
              @endif
          @endif
        </li>

        {{-- LAST ACTIVITY --}}
        <li class="mb2 mb0-ns dn di-ns tc {{ htmldir() == 'ltr' ? 'mr3-ns' : 'ml3-ns' }}">
          <span class="{{ htmldir() == 'ltr' ? 'mr1' : 'ml1' }}">@include('partials.icons.header_people')</span>
          @if (is_null($contact->getLastActivityDate()))
            {{ trans('people.last_activity_date_empty') }}
          @else
            {{ trans('people.last_activity_date', ['date' => \App\Helpers\DateHelper::getShortDate($contact->getLastActivityDate())]) }}
          @endif
        </li>

        {{-- LAST CALLED --}}
        <li class="mb2 mb0-ns dn di-ns tc {{ htmldir() == 'ltr' ? 'mr3-ns' : 'ml3-ns' }}">
          <span class="{{ htmldir() == 'ltr' ? 'mr1' : 'ml1' }}">@include('partials.icons.header_call')</span>
          @if (is_null($contact->getLastCalled()))
            {{ trans('people.last_called_empty') }}
          @else
            {{ trans('people.last_called', ['date' => \App\Helpers\DateHelper::getShortDate($contact->getLastCalled())]) }}
          @endif
        </li>

        {{-- DESCRIPTION --}}
        @if ($contact->description)
        <li class="mb2 mb0-ns di-ns db tc {{ htmldir() == 'ltr' ? 'mr3-ns' : 'ml3-ns' }}">
          @include('partials.icons.header_description')
          {{ $contact->description }}
        </li>
        @endif

        {{-- STAY IN TOUCH --}}
        <li class="mb2 mb0-ns di-ns db tc {{ htmldir() == 'ltr' ? 'mr3-ns' : 'ml3-ns' }}">
          @include('partials.icons.header_stayintouch')
          <stay-in-touch :contact="{{ $contact }}" hash="{{ $contact->hashID() }}" limited="{{ auth()->user()->account->hasLimitations() }}"></stay-in-touch>
        </li>
      </ul>

      <tags hash="{{ $contact->hashID() }}" class="mb3 mb0-ns"></tags>

      <div class="absolute-ns tc profile-edit-contact-button">
        <a href="{{ route('people.edit', $contact) }}" class="btn" id="button-edit-contact">{{ trans('people.edit_contact_information') }}</a>
      </div>
    </div>
</div>

<div class="ph3 ph5-ns pv2 cf w-100">
    <div class="mw9 center dt w-100">
      @include ('partials.errors')
      @include ('partials.notification')
    </div>
</div>
