@extends('main')

@section('title', 'Privacy')

@push('css')
@endpush

@section('message')
    @include('layouts.message')
@endsection

@section('header')
    @include('layouts.header')
@endsection

@section('main')
    <section class="bg-white">
        <div class="max-w-7xl mx-auto pb-4 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <svg
                class="absolute top-full right-full transform translate-x-1/3 -translate-y-1/4 lg:translate-x-1/2 xl:-translate-y-1/2"
                width="404" height="404" fill="none" viewBox="0 0 404 404" role="img" aria-labelledby="svg-workcation">
                <title id="svg-workcation">Privacy</title>
                <defs>
                    <pattern id="ad119f34-7694-4c31-947f-5c9d249b21f3" x="0" y="0" width="20" height="20"
                             patternUnits="userSpaceOnUse">
                        <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor"/>
                    </pattern>
                </defs>
                <rect width="404" height="404" fill="url(#ad119f34-7694-4c31-947f-5c9d249b21f3)"/>
            </svg>

            <div class="relative">
                <img class="mx-auto h-18"
                     src="{{asset('images/logo/privacy.svg')}}"
                     alt="Workcation">
                <blockquote class="mt-10 tracking-wide py-10 px-6 bg-indigo-50">
                    <p class=" text-2xl leading-9 font-medium mb-10">
                        Privacy Policy for BookStory
                    </p>

                    <p class="text-sm text-gray-700">If you require any more information or have any questions about our
                        privacy policy, please feel
                        free to contact us by: BookStory.site@gmail.com.</p>

                    <p class="text-sm text-gray-700"> At BookStory, the privacy of our visitors is of extreme importance
                        to us. This privacy policy
                        document outlines the types of personal information is received and collected by BookStory and
                        how it
                        is used. </p>

                    <p class="mt-4 mb-4">Log Files</p>
                    <p class="text-sm text-gray-700"> Like many other Web sites, BookStory makes use of log files. The
                        information inside the log files
                        includes internet protocol ( IP ) addresses, type of browser, Internet Service Provider ( ISP ),
                        date/time stamp, referring/exit pages, and number of clicks to analyze trends, administer the
                        site, track user’s movement around the site, and gather demographic information. IP addresses,
                        and other such information are not linked to any information that is personally
                        identifiable.</p>

                    <p class="mt-4 mb-4"> Children’s Privacy​</p>
                    <p class="text-sm text-gray-700"> Our Service does not address anyone under the age of 18
                        (“Children”).​</p>

                    <p class="text-sm text-gray-700"> We do not knowingly collect personally identifiable information
                        from anyone under the age of 18.
                        If you are a parent or guardian and you are aware that your Children has provided us with
                        Personal Data, please contact us. If we become aware that we have collected Personal Data from
                        children without verification of parental consent, we take steps to remove that information from
                        our servers.</p>

                    <p class="mt-4 mb-4"> Cookies and Web Beacons</p>
                    <p class="text-sm text-gray-700"> BookStory does use cookies to store information about visitors
                        preferences, record user-specific
                        information on which pages the user access or visit, customize Web page content based on
                        visitors browser type or other information that the visitor sends via their browser.</p>

                    <p class="mt-4 mb-4"> DoubleClick DART Cookie</p>
                    <p class="text-sm text-gray-700"> .:: Google, as a third party vendor, uses cookies to serve ads on
                        BookStory.</p>
                    <p class="text-sm text-gray-700"> .:: Google's use of the DART cookie enables it to serve ads to
                        users based on their visit to
                        BookStory and other sites on the Internet.</p>
                    <p class="text-sm text-gray-700"> .:: Users may opt out of the use of the DART cookie by visiting
                        the Google ad and content
                        network privacy policy at the following URL - http://www.google.com/privacy_ads.html</p>

                    <p class="text-sm text-gray-700"> Some of our advertising partners may use cookies and web beacons
                        on our site. Our advertising
                        partners include ....</p>

                    <p class="mt-4 mb-4"> Google Adsense</p>
                    <p class="text-sm text-gray-700"> These third-party ad servers or ad networks use technology to the
                        advertisements and links that
                        appear on BookStory send directly to your browsers. They automatically receive your IP address
                        when
                        this occurs. Other technologies ( such as cookies, JavaScript, or Web Beacons ) may also be used
                        by the third-party ad networks to measure the effectiveness of their advertisements and / or to
                        personalize the advertising content that you see.</p>

                    <p class="text-sm text-gray-700"> BookStory has no access to or control over these cookies that are
                        used by third-party
                        advertisers.</p>

                    <p class="text-sm text-gray-700"> You should consult the respective privacy policies of these
                        third-party ad servers for more
                        detailed information on their practices as well as for instructions about how to opt-out of
                        certain practices. BookStory's privacy policy does not apply to, and we cannot control the
                        activities
                        of, such other advertisers or web sites.</p>
                    <p class="text-sm text-gray-700"> If you wish to disable cookies, you may do so through your
                        individual browser options. More
                        detailed information about cookie management with specific web browsers can be found at the
                        browsers' respective websites.</p>

                </blockquote>
            </div>
        </div>
    </section>
@endsection

@push('javascript')
@endpush
