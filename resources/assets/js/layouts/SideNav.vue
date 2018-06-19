<template>
<nav class="sidebar" data-sidebar-anyclick-close="">
	<!-- START sidebar nav-->
	<ul class="nav">
		<!-- Iterates over all sidebar items-->
		<li class="nav-heading">
			<span data-localize="sidebar.heading.HEADER">Main Navigation</span>
		</li>
		<router-link tag="li" to="/home">
			<a href="/home" title="Dashboard">
				<img src="/assets/vendor/icon-pack-1/svg/home-icon.png" width="36" height="36"/>
				<span data-localize="sidebar.nav.DASHBOARD">Dashboard</span>
			</a>
		</router-link>
		<router-link tag="li" to="/children">
			<a href="/children" title="Children">
				<img src="/assets/vendor/icon-pack-1/svg/child.svg" width="36" height="36"/>
				<span data-localize="sidebar.nav.WIDGETS">Children</span>
			</a>
		</router-link>
		<!-- @can('edit', \App\Models\ChildParent::class) -->
			<router-link tag="li" to="/parents">
				<a href="/parents" title="Parents">
					<img src="/assets/vendor/icon-pack-1/svg/couple.png" width="36"
						 height="36"/>
					<span data-localize="sidebar.nav.WIDGETS">Parents</span>
				</a>
			</router-link>
		<!-- @endcan -->

		<!-- @can('edit', \App\Models\Staff::class) -->
			<router-link tag="li" to="/staff">
				<a href="/staff" title="Staff Members">
					<img src="/assets/vendor/icon-pack-1/svg/telemarketer.png" width="36"
						 height="36"/>
					<span data-localize="sidebar.nav.WIDGETS">Staff Members</span>
				</a>
			</router-link>
		<!-- @endcan -->

		<router-link tag="li" to="/billing">
			<a href="/billing" title="Billing">
				<img src="/assets/vendor/icon-pack-1/svg/billing.png" width="36" height="36"/>
				<span data-localize="sidebar.nav.WIDGETS">Billing</span>
			</a>
		</router-link>

		<!-- @can('showGeneric', \App\Models\Groups\Group::class) -->
			<router-link tag="li" to="/groups">
				<a href="/groups" title="Groups">
					<img src="/assets/vendor/icon-pack-1/svg/group.png" width="36" height="36"/>
					<span data-localize="sidebar.nav.WIDGETS">Groups</span>
				</a>
			</router-link>
		<!-- @endcan -->

		<li class=" ">
			<a href="#admins" class="accordion-toggle collapsed" title="Admin" data-toggle="collapse">
				<img src="/assets/vendor/icon-pack-1/svg/admin.png" width="36" height="36"/>
				<span data-localize="sidebar.nav.form.FORM">Admin</span>
			</a>
			<ul class="nav sidebar-subnav collapse" id="admins">
				<li class="sidebar-subnav-header">Forms</li>
				<li class=" ">
					<a href="" title="Settings">
						<span data-localize="sidebar.nav.form.SETTINGS">Settings</span>
					</a>
				</li>
				<li class=" ">
					<a href="" title="Users">
						<span data-localize="sidebar.nav.form.USERS">Users</span>
					</a>
				</li>
				<li class=" ">
					<a href="" title="Roles & Permissions">
						<span>Roles & Permissions</span>
					</a>
				</li>
				<li class=" ">
					<a href="" title="Subcriptions">
						<span>Subcriptions</span>
					</a>
				</li>
			</ul>
		</li>
	</ul>
	<div class="help-box">
		<h5 class="visible-lg text-muted m-t-0">A&M Digital Technlogies</h5>
		<h5 class="text-muted m-t-0">&copy; 2017 All Rights Reserved</h5>
	</div>
	<!-- END sidebar nav-->
</nav>
</template>