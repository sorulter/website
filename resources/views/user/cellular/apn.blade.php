<!DOCTYPE plist PUBLIC "-//Apple//DTD PLIST 1.0//EN" "http://www.apple.com/DTDs/PropertyList-1.0.dtd">
<plist version="1.0">
<dict>
	<key>PayloadContent</key>
	<array>
		<dict>
			<key>PayloadContent</key>
			<array>
				<dict>
					<key>DefaultsData</key>
					<dict>
						<key>apns</key>
						<array>
							<dict>
								<key>apn</key>
								<string>{{ $apnName }}</string>
								<key>proxy</key>
								<string>{{$user->port->node_name}}.{{env('NODE_BASE_NAME')}}</string>
								<key>proxyPort</key>
								<integer>{{$user->port->port}}</integer>
								<key>username</key>
								<string></string>
							</dict>
						</array>
					</dict>
					<key>DefaultsDomainName</key>
					<string>com.apple.managedCarrier</string>
				</dict>
			</array>
			<key>PayloadDescription</key>
			<string></string>
			<key>PayloadDisplayName</key>
			<string>APN</string>
			<key>PayloadIdentifier</key>
			<string>iProxier.com.apn</string>
			<key>PayloadOrganization</key>
			<string></string>
			<key>PayloadType</key>
			<string>com.apple.apn.managed</string>
			<key>PayloadUUID</key>
			<string>{{ $apnUUID }}</string>
			<key>PayloadVersion</key>
			<integer>1</integer>
		</dict>
	</array>
	<key>PayloadDescription</key>
	<string>www.iProxier.com Cellular Data Profile｜IPX移动网络配置文件</string>
	<key>PayloadDisplayName</key>
	<string>IPX＠iProxier.com</string>
	<key>PayloadIdentifier</key>
	<string>www.iProxier.com</string>
	<key>PayloadOrganization</key>
	<string>www.iProxier.com</string>
	<key>PayloadRemovalDisallowed</key>
	<false/>
	<key>PayloadType</key>
	<string>Configuration</string>
	<key>PayloadUUID</key>
	<string>{{ $configUUID }}</string>
	<key>PayloadVersion</key>
	<integer>1</integer>
</dict>
</plist>
