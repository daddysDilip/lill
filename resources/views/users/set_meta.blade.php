<!DOCTYPE html>
<html>
<head>
	{{-- <title></title> --}}

  <meta name="viewport" content="width=device-width">
  
  <title>everyday_expense/create.blade.php at main · daddysDilip/everyday_expense</title>
    <meta name="description" content="everyday expense is a application for store everyday transactions. - daddysDilip/everyday_expense">
    <link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="GitHub">
  <link rel="fluid-icon" href="https://github.com/fluidicon.png" title="GitHub">
  <meta property="fb:app_id" content="1401488693436528">
  <meta name="apple-itunes-app" content="app-id=1477376905" />
    <meta name="twitter:image:src" content="https://avatars.githubusercontent.com/u/79186942?s=400&amp;v=4" /><meta name="twitter:site" content="@github" /><meta name="twitter:card" content="summary" /><meta name="twitter:title" content="daddysDilip/everyday_expense" /><meta name="twitter:description" content="everyday expense is a application for store everyday transactions. - daddysDilip/everyday_expense" />
    <meta property="og:image" content="https://avatars.githubusercontent.com/u/79186942?s=400&amp;v=4" /><meta property="og:site_name" content="GitHub" /><meta property="og:type" content="object" /><meta property="og:title" content="daddysDilip/everyday_expense" /><meta property="og:url" content="https://github.com/daddysDilip/everyday_expense" /><meta property="og:description" content="everyday expense is a application for store everyday transactions. - daddysDilip/everyday_expense" />



  <link rel="assets" href="https://github.githubassets.com/">
    <link rel="shared-web-socket" href="wss://alive.github.com/_sockets/u/79186942/ws?session=eyJ2IjoiVjMiLCJ1Ijo3OTE4Njk0MiwicyI6NjQ5NDY1MzkzLCJjIjoxODQxMTU4MjExLCJ0IjoxNjE1MTk2Njc0fQ==--1e775ed69286f230dea097d2d0f0435bde995416472875d7e5f251dc29734e30" data-refresh-url="/_alive">
    <link rel="shared-web-socket-src" href="/socket-worker-5029ae85.js">
  <link rel="sudo-modal" href="/sessions/sudo_modal">

  <meta name="request-id" content="8338:49A5:7E481C:8EA5EC:6045F1FB" data-pjax-transient="true" /><meta name="html-safe-nonce" content="2a33577e9a8754f9e39ea1a7ebfa626dada7adb14c90c97f92215c6ab4396af6" data-pjax-transient="true" /><meta name="visitor-payload" content="eyJyZWZlcnJlciI6bnVsbCwicmVxdWVzdF9pZCI6IjgzMzg6NDlBNTo3RTQ4MUM6OEVBNUVDOjYwNDVGMUZCIiwidmlzaXRvcl9pZCI6Ijc2MDM5MTU4MDE1ODU0MzE1MTkiLCJyZWdpb25fZWRnZSI6ImFwLXNvdXRoLTEiLCJyZWdpb25fcmVuZGVyIjoiaWFkIn0=" data-pjax-transient="true" /><meta name="visitor-hmac" content="f56a88c3f8fc0c5a5ac27d3c545966a5bfdf0396ca4cd3a7ac324fd1f4b2a1eb" data-pjax-transient="true" />

    <meta name="hovercard-subject-tag" content="repository:339626646" data-pjax-transient>


  <meta name="github-keyboard-shortcuts" content="repository,source-code" data-pjax-transient="true" />

  

  <meta name="selected-link" value="repo_source" data-pjax-transient>

    <meta name="google-site-verification" content="c1kuD-K2HIVF635lypcsWPoD4kilo5-jA_wBFyT4uMY">
  <meta name="google-site-verification" content="KT5gs8h0wvaagLKAVWq8bbeNwnZZK1r1XQysX3xurLU">
  <meta name="google-site-verification" content="ZzhVyEFwb7w3e0-uOTltm8Jsck2F5StVihD0exw2fsA">
  <meta name="google-site-verification" content="GXs5KoUUkNCoaAZn7wPN-t01Pywp9M3sEjnt_3_ZWPc">

  <meta name="octolytics-host" content="collector.githubapp.com" /><meta name="octolytics-app-id" content="github" /><meta name="octolytics-event-url" content="https://collector.githubapp.com/github-external/browser_event" /><meta name="octolytics-actor-id" content="79186942" /><meta name="octolytics-actor-login" content="daddysDilip" /><meta name="octolytics-actor-hash" content="377ed8b34c5b2c4144bc5388aa5199abf3f8ccbf7eec5f4281b8507c57709e8b" />

  <meta name="analytics-location" content="/&lt;user-name&gt;/&lt;repo-name&gt;/blob/show" data-pjax-transient="true" />


  <meta name="optimizely-datafile" content="{&quot;version&quot;: &quot;4&quot;, &quot;rollouts&quot;: [], &quot;typedAudiences&quot;: [], &quot;anonymizeIP&quot;: true, &quot;projectId&quot;: &quot;16737760170&quot;, &quot;variables&quot;: [], &quot;featureFlags&quot;: [], &quot;experiments&quot;: [{&quot;status&quot;: &quot;Running&quot;, &quot;audienceIds&quot;: [], &quot;variations&quot;: [{&quot;variables&quot;: [], &quot;id&quot;: &quot;19739506060&quot;, &quot;key&quot;: &quot;en&quot;}, {&quot;variables&quot;: [], &quot;id&quot;: &quot;19720506378&quot;, &quot;key&quot;: &quot;pt&quot;}], &quot;id&quot;: &quot;19741925936&quot;, &quot;key&quot;: &quot;homepage_translation&quot;, &quot;layerId&quot;: &quot;19739776731&quot;, &quot;trafficAllocation&quot;: [{&quot;entityId&quot;: &quot;19720506378&quot;, &quot;endOfRange&quot;: 5000}, {&quot;entityId&quot;: &quot;19739506060&quot;, &quot;endOfRange&quot;: 10000}], &quot;forcedVariations&quot;: {}}], &quot;audiences&quot;: [{&quot;conditions&quot;: &quot;[\&quot;or\&quot;, {\&quot;match\&quot;: \&quot;exact\&quot;, \&quot;name\&quot;: \&quot;$opt_dummy_attribute\&quot;, \&quot;type\&quot;: \&quot;custom_attribute\&quot;, \&quot;value\&quot;: \&quot;$opt_dummy_value\&quot;}]&quot;, &quot;id&quot;: &quot;$opt_dummy_audience&quot;, &quot;name&quot;: &quot;Optimizely-Generated Audience for Backwards Compatibility&quot;}], &quot;groups&quot;: [{&quot;policy&quot;: &quot;random&quot;, &quot;trafficAllocation&quot;: [{&quot;entityId&quot;: &quot;20065350824&quot;, &quot;endOfRange&quot;: 10000}], &quot;experiments&quot;: [{&quot;status&quot;: &quot;Running&quot;, &quot;audienceIds&quot;: [], &quot;variations&quot;: [{&quot;variables&quot;: [], &quot;id&quot;: &quot;20061181493&quot;, &quot;key&quot;: &quot;control&quot;}, {&quot;variables&quot;: [], &quot;id&quot;: &quot;20046091568&quot;, &quot;key&quot;: &quot;most_popular&quot;}], &quot;id&quot;: &quot;20065350824&quot;, &quot;key&quot;: &quot;pricing_page&quot;, &quot;layerId&quot;: &quot;20047761391&quot;, &quot;trafficAllocation&quot;: [{&quot;entityId&quot;: &quot;20061181493&quot;, &quot;endOfRange&quot;: 5000}, {&quot;entityId&quot;: &quot;20046091568&quot;, &quot;endOfRange&quot;: 10000}], &quot;forcedVariations&quot;: {&quot;1693726779.1607624005&quot;: &quot;most_popular&quot;, &quot;b3d9f4f9910bc46c43a8d65ab83d8570&quot;: &quot;most_popular&quot;}}], &quot;id&quot;: &quot;19972601768&quot;}], &quot;attributes&quot;: [{&quot;id&quot;: &quot;16822470375&quot;, &quot;key&quot;: &quot;user_id&quot;}, {&quot;id&quot;: &quot;17143601254&quot;, &quot;key&quot;: &quot;spammy&quot;}, {&quot;id&quot;: &quot;18175660309&quot;, &quot;key&quot;: &quot;organization_plan&quot;}, {&quot;id&quot;: &quot;18813001570&quot;, &quot;key&quot;: &quot;is_logged_in&quot;}, {&quot;id&quot;: &quot;19073851829&quot;, &quot;key&quot;: &quot;geo&quot;}], &quot;botFiltering&quot;: false, &quot;accountId&quot;: &quot;16737760170&quot;, &quot;events&quot;: [{&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;17911811441&quot;, &quot;key&quot;: &quot;hydro_click.dashboard.teacher_toolbox_cta&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18124116703&quot;, &quot;key&quot;: &quot;submit.organizations.complete_sign_up&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18145892387&quot;, &quot;key&quot;: &quot;no_metric.tracked_outside_of_optimizely&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18178755568&quot;, &quot;key&quot;: &quot;click.org_onboarding_checklist.add_repo&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18180553241&quot;, &quot;key&quot;: &quot;submit.repository_imports.create&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18186103728&quot;, &quot;key&quot;: &quot;click.help.learn_more_about_repository_creation&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18188530140&quot;, &quot;key&quot;: &quot;test_event.do_not_use_in_production&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18191963644&quot;, &quot;key&quot;: &quot;click.empty_org_repo_cta.transfer_repository&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18195612788&quot;, &quot;key&quot;: &quot;click.empty_org_repo_cta.import_repository&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18210945499&quot;, &quot;key&quot;: &quot;click.org_onboarding_checklist.invite_members&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18211063248&quot;, &quot;key&quot;: &quot;click.empty_org_repo_cta.create_repository&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18215721889&quot;, &quot;key&quot;: &quot;click.org_onboarding_checklist.update_profile&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18224360785&quot;, &quot;key&quot;: &quot;click.org_onboarding_checklist.dismiss&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18234832286&quot;, &quot;key&quot;: &quot;submit.organization_activation.complete&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18252392383&quot;, &quot;key&quot;: &quot;submit.org_repository.create&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18257551537&quot;, &quot;key&quot;: &quot;submit.org_member_invitation.create&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18259522260&quot;, &quot;key&quot;: &quot;submit.organization_profile.update&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18564603625&quot;, &quot;key&quot;: &quot;view.classroom_select_organization&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18568612016&quot;, &quot;key&quot;: &quot;click.classroom_sign_in_click&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18572592540&quot;, &quot;key&quot;: &quot;view.classroom_name&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18574203855&quot;, &quot;key&quot;: &quot;click.classroom_create_organization&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18582053415&quot;, &quot;key&quot;: &quot;click.classroom_select_organization&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18589463420&quot;, &quot;key&quot;: &quot;click.classroom_create_classroom&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18591323364&quot;, &quot;key&quot;: &quot;click.classroom_create_first_classroom&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18591652321&quot;, &quot;key&quot;: &quot;click.classroom_grant_access&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18607131425&quot;, &quot;key&quot;: &quot;view.classroom_creation&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;18831680583&quot;, &quot;key&quot;: &quot;upgrade_account_plan&quot;}, {&quot;experimentIds&quot;: [&quot;20065350824&quot;], &quot;id&quot;: &quot;19064064515&quot;, &quot;key&quot;: &quot;click.signup&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19075373687&quot;, &quot;key&quot;: &quot;click.view_account_billing_page&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19077355841&quot;, &quot;key&quot;: &quot;click.dismiss_signup_prompt&quot;}, {&quot;experimentIds&quot;: [&quot;20065350824&quot;], &quot;id&quot;: &quot;19079713938&quot;, &quot;key&quot;: &quot;click.contact_sales&quot;}, {&quot;experimentIds&quot;: [&quot;20065350824&quot;], &quot;id&quot;: &quot;19120963070&quot;, &quot;key&quot;: &quot;click.compare_account_plans&quot;}, {&quot;experimentIds&quot;: [&quot;20065350824&quot;], &quot;id&quot;: &quot;19151690317&quot;, &quot;key&quot;: &quot;click.upgrade_account_cta&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19424193129&quot;, &quot;key&quot;: &quot;click.open_account_switcher&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19520330825&quot;, &quot;key&quot;: &quot;click.visit_account_profile&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;19540970635&quot;, &quot;key&quot;: &quot;click.switch_account_context&quot;}, {&quot;experimentIds&quot;: [&quot;19741925936&quot;], &quot;id&quot;: &quot;19730198868&quot;, &quot;key&quot;: &quot;submit.homepage_signup&quot;}, {&quot;experimentIds&quot;: [&quot;19741925936&quot;], &quot;id&quot;: &quot;19820830627&quot;, &quot;key&quot;: &quot;click.homepage_signup&quot;}, {&quot;experimentIds&quot;: [&quot;20065350824&quot;], &quot;id&quot;: &quot;19988571001&quot;, &quot;key&quot;: &quot;click.create_enterprise_trial&quot;}, {&quot;experimentIds&quot;: [&quot;20065350824&quot;], &quot;id&quot;: &quot;20036538294&quot;, &quot;key&quot;: &quot;click.create_organization_team&quot;}, {&quot;experimentIds&quot;: [], &quot;id&quot;: &quot;20040653299&quot;, &quot;key&quot;: &quot;click.input_enterprise_trial_form&quot;}, {&quot;experimentIds&quot;: [&quot;20065350824&quot;], &quot;id&quot;: &quot;20062030003&quot;, &quot;key&quot;: &quot;click.continue_with_team&quot;}, {&quot;experimentIds&quot;: [&quot;20065350824&quot;], &quot;id&quot;: &quot;20068947153&quot;, &quot;key&quot;: &quot;click.create_organization_free&quot;}], &quot;revision&quot;: &quot;485&quot;}" />
  <!-- To prevent page flashing, the optimizely JS needs to be loaded in the
    <head> tag before the DOM renders -->
  <script crossorigin="anonymous" defer="defer" integrity="sha512-W1d5sgym3BsWbUe7hCryQNFytsdsH6xKMY0wpid1izznZdSd6hBG7sOj+j6ISmYkoqPonCpkWKp0aG/MGGKRKg==" type="application/javascript" src="https://github.githubassets.com/assets/optimizely-5b5779b2.js"></script>



  

      <meta name="hostname" content="github.com">
    <meta name="user-login" content="daddysDilip">


      <meta name="expected-hostname" content="github.com">

      <meta name="js-proxy-site-detection-payload" content="ZjBkNTI3YjJhYjM2ODkwYzA4N2IzODdiMGM5MzQ4MDk3NzEwMWJjNjQ4ZjgwZDdjN2VjNTc4N2EwMmFiYWZkN3x7InJlbW90ZV9hZGRyZXNzIjoiMTE3Ljk5LjEwOS40MCIsInJlcXVlc3RfaWQiOiI4MzM4OjQ5QTU6N0U0ODFDOjhFQTVFQzo2MDQ1RjFGQiIsInRpbWVzdGFtcCI6MTYxNTE5NjY3NCwiaG9zdCI6ImdpdGh1Yi5jb20ifQ==">

    <meta name="enabled-features" content="MARKETPLACE_PENDING_INSTALLATIONS,JS_HTTP_CACHE_HEADERS">

  <meta http-equiv="x-pjax-version" content="6384279d2222f6dd46a66b99690c33581cded95dd9218149db08dfe1eea424c9">
  

        <link href="https://github.com/daddysDilip/everyday_expense/commits/main.atom" rel="alternate" title="Recent Commits to everyday_expense:main" type="application/atom+xml">

  <meta name="go-import" content="github.com/daddysDilip/everyday_expense git https://github.com/daddysDilip/everyday_expense.git">

  <meta name="octolytics-dimension-user_id" content="79186942" /><meta name="octolytics-dimension-user_login" content="daddysDilip" /><meta name="octolytics-dimension-repository_id" content="339626646" /><meta name="octolytics-dimension-repository_nwo" content="daddysDilip/everyday_expense" /><meta name="octolytics-dimension-repository_public" content="true" /><meta name="octolytics-dimension-repository_is_fork" content="false" /><meta name="octolytics-dimension-repository_network_root_id" content="339626646" /><meta name="octolytics-dimension-repository_network_root_nwo" content="daddysDilip/everyday_expense" />



    <link rel="canonical" href="https://github.com/daddysDilip/everyday_expense/blob/main/resources/views/admin/translation/create.blade.php" data-pjax-transient>


  <meta name="browser-stats-url" content="https://api.github.com/_private/browser/stats">

  <meta name="browser-errors-url" content="https://api.github.com/_private/browser/errors">

  <meta name="browser-optimizely-client-errors-url" content="https://api.github.com/_private/browser/optimizely_client/errors">

  <link rel="mask-icon" href="https://github.githubassets.com/pinned-octocat.svg" color="#000000">
  <link rel="alternate icon" class="js-site-favicon" type="image/png" href="https://github.githubassets.com/favicons/favicon.png">
  <link rel="icon" class="js-site-favicon" type="image/svg+xml" href="https://github.githubassets.com/favicons/favicon.svg">

<meta name="theme-color" content="#1e2327">
    <meta name="color-scheme" content="dark light">


  <link rel="manifest" href="/manifest.json" crossOrigin="use-credentials">
</head>
<body>

</body>
</html>