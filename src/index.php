<!DOCTYPE html>
<html lang="en" data-theme="light">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Network Speed Test</title>
		<link
			href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css"
			rel="stylesheet"
		/>
		<script src="https://cdn.tailwindcss.com"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<style>
			.progress-circle {
				stroke-dasharray: 276.46;
				stroke-dashoffset: 276.46;
				transition: stroke-dashoffset 0.5s ease;
			}

			.animate-fade-out {
				animation: fadeOut 0.3s ease-out forwards;
			}

			@keyframes fadeOut {
				from {
					opacity: 1;
					transform: translateX(0);
				}

				to {
					opacity: 0;
					transform: translateX(-10px);
				}
			}

			.swal2-popup {
				border-radius: 1rem;
				backdrop-filter: blur(10px);
				padding: 2rem;
			}

			[data-theme="dark"] .swal2-popup {
				background: rgba(30, 41, 59, 0.95) !important;
				box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3) !important;
				border: 1px solid rgba(255, 255, 255, 0.1);
			}

			[data-theme="dark"] .swal2-title {
				color: rgba(255, 255, 255, 0.9) !important;
			}

			[data-theme="dark"] .swal2-html-container {
				color: rgba(255, 255, 255, 0.7) !important;
			}

			[data-theme="dark"] .swal2-confirm {
				background: #e11d48 !important;
				box-shadow: 0 2px 8px rgba(225, 29, 72, 0.2) !important;
			}

			[data-theme="dark"] .swal2-cancel {
				background: #475569 !important;
				box-shadow: 0 2px 8px rgba(71, 85, 105, 0.2) !important;
			}

			/* Toast Styling */
			.swal2-toast {
				background: rgba(30, 41, 59, 0.98) !important;
				box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2) !important;
			}

			[data-theme="dark"] .swal2-toast .swal2-title {
				color: rgba(255, 255, 255, 0.9) !important;
			}

			.swal2-toast.swal2-icon-success {
				border-left: 4px solid #22c55e !important;
			}

			.swal2-toast.swal2-icon-error {
				border-left: 4px solid #ef4444 !important;
			}

			.swal2-toast.swal2-icon-warning {
				border-left: 4px solid #f59e0b !important;
			}

			.swal2-toast.swal2-icon-info {
				border-left: 4px solid #3b82f6 !important;
			}
		</style>
		<script>
			// Update your tailwind config to include better animation
			tailwind.config = {
				darkMode: ["class", '[data-theme="dark"]'],
				theme: {
					extend: {
						animation: {
							gradient: "gradient 8s linear infinite",
						},
						keyframes: {
							gradient: {
								"0%, 100%": {
									"background-position": "0% 50%",
								},
								"50%": {
									"background-position": "100% 50%",
								},
							},
						},
						backgroundColor: {
							"white/80": "rgba(255, 255, 255, 0.8)",
						},
					},
				},
			};
		</script>
		<link
			rel="icon"
			type="image/svg+xml"
			href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PHBhdGggZmlsbD0iIzAwMCIgZD0iTTEyIDJDNi40ODggMiAyIDYuNDg4IDIgMTJzNC40ODggMTAgMTAgMTAgMTAtNC40ODggMTAtMTBTMTcuNTEyIDIgMTIgMnptMCA2YzIuMjEgMCA0IDEuNzkgNCA0cy0xLjc5IDQtNCA0LTQtMS43OS00LTQgMS43OS00IDQtNHoiLz48L3N2Zz4="
		/>
	</head>

	<body class="min-h-screen transition-colors duration-300">
		<div
			class="fixed inset-0 bg-gradient-to-br from-base-200 via-base-100 to-base-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 -z-10 animate-gradient bg-[length:400%_400%]"
		></div>

		<div class="container mx-auto px-4 py-8 max-w-6xl relative">
			<!-- Theme Toggle -->
			<div class="absolute top-4 right-4 z-10">
				<label
					class="swap swap-rotate bg-base-200 p-2 rounded-full hover:bg-base-300 transition-colors"
				>
					<input type="checkbox" class="theme-controller" value="dark" />
					<svg class="swap-on w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
						<path
							d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
						></path>
					</svg>
					<svg class="swap-off w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
						<path
							d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
						></path>
					</svg>
				</label>
			</div>

			<!-- Header -->
			<div class="text-center mb-12">
				<div class="inline-block">
					<h1
						class="text-5xl font-bold bg-gradient-to-r from-primary via-secondary to-accent bg-clip-text text-transparent animate-gradient bg-[length:200%_auto] mb-4"
					>
						Network Speed Test
					</h1>
					<p class="text-base-content/70 text-lg">
						Comprehensive network performance analysis
					</p>
				</div>
			</div>

			<!-- Controls -->
			<div
				class="flex flex-col md:flex-row justify-center items-center gap-8 mb-12"
			>
				<div class="card bg-base-200 shadow-xl w-full max-w-xs">
					<div class="card-body p-6">
						<h3 class="font-semibold text-base-content/80 mb-2">
							Test Duration
						</h3>
						<input
							type="range"
							id="testDuration"
							min="5"
							max="30"
							value="10"
							class="range range-primary range-xs"
							step="5"
						/>
						<div
							class="w-full flex justify-between text-xs text-base-content/60"
						>
							<span>5s</span>
							<span>30s</span>
						</div>
					</div>
				</div>

				<button id="startTest" class="btn btn-primary btn-lg glass">
					<svg
						class="w-6 h-6 mr-2"
						fill="none"
						stroke="currentColor"
						viewBox="0 0 24 24"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"
						/>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
						/>
					</svg>
					Start Test
					<span class="loading loading-spinner loading-sm hidden ml-2"></span>
				</button>
			</div>

			<!-- Status Banner -->
			<div
				id="statusBanner"
				class="alert shadow-lg mb-8 hidden max-w-2xl mx-auto"
			>
				<svg
					class="w-6 h-6 shrink-0"
					fill="none"
					stroke="currentColor"
					viewBox="0 0 24 24"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						stroke-width="2"
						d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
					/>
				</svg>
				<span id="statusMessage"></span>
			</div>

			<!-- Replace the Metrics Cards section with this updated version -->
			<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
				<!-- Ping -->
				<div
					class="card bg-base-200/50 backdrop-blur-sm shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1"
				>
					<div class="card-body">
						<h2 class="card-title text-primary mb-4 flex gap-2">
							<svg
								class="w-6 h-6"
								fill="none"
								stroke="currentColor"
								viewBox="0 0 24 24"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									d="M13 10V3L4 14h7v7l9-11h-7z"
								/>
							</svg>
							Latency
						</h2>
						<div class="flex items-center justify-between">
							<div class="relative w-24 h-24">
								<svg class="w-24 h-24 -rotate-90">
									<circle
										class="text-base-300"
										stroke-width="8"
										stroke="currentColor"
										fill="transparent"
										r="44"
										cx="48"
										cy="48"
									/>
									<circle
										class="text-primary progress-circle"
										stroke-width="8"
										stroke="currentColor"
										fill="transparent"
										r="44"
										cx="48"
										cy="48"
									/>
								</svg>
								<div
									class="absolute inset-0 flex items-center justify-center flex-col"
								>
									<div id="pingProgress" class="text-lg font-bold">0%</div>
									<div class="text-xs font-semibold text-base-content/60">
										PING
									</div>
								</div>
							</div>
							<div class="text-right">
								<div class="text-3xl font-bold font-mono" id="pingResult">
									-- ms
								</div>
								<div class="text-sm text-base-content/60" id="pingJitter">
									Jitter: -- ms
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Download -->
				<div
					class="card bg-base-200/50 backdrop-blur-sm shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1"
				>
					<div class="card-body">
						<h2 class="card-title text-success mb-4 flex gap-2">
							<svg
								class="w-6 h-6"
								fill="none"
								stroke="currentColor"
								viewBox="0 0 24 24"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
								/>
							</svg>
							Download
						</h2>
						<div class="flex items-center justify-between">
							<div class="relative w-24 h-24">
								<svg class="w-24 h-24 -rotate-90">
									<circle
										class="text-base-300"
										stroke-width="8"
										stroke="currentColor"
										fill="transparent"
										r="44"
										cx="48"
										cy="48"
									/>
									<circle
										class="text-success progress-circle"
										stroke-width="8"
										stroke="currentColor"
										fill="transparent"
										r="44"
										cx="48"
										cy="48"
									/>
								</svg>
								<div
									class="absolute inset-0 flex items-center justify-center flex-col"
								>
									<div id="downloadProgress" class="text-lg font-bold">0%</div>
									<div class="text-xs font-semibold text-base-content/60">
										DOWN
									</div>
								</div>
							</div>
							<div class="text-right">
								<div class="text-3xl font-bold font-mono" id="downloadResult">
									-- Mbps
								</div>
								<div class="text-sm text-base-content/60" id="downloadPeak">
									Peak: -- Mbps
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Upload -->
				<div
					class="card bg-base-200/50 backdrop-blur-sm shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1"
				>
					<div class="card-body">
						<h2 class="card-title text-warning mb-4 flex gap-2">
							<svg
								class="w-6 h-6"
								fill="none"
								stroke="currentColor"
								viewBox="0 0 24 24"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
								/>
							</svg>
							Upload
						</h2>
						<div class="flex items-center justify-between">
							<div class="relative w-24 h-24">
								<svg class="w-24 h-24 -rotate-90">
									<circle
										class="text-base-300"
										stroke-width="8"
										stroke="currentColor"
										fill="transparent"
										r="44"
										cx="48"
										cy="48"
									/>
									<circle
										class="text-warning progress-circle"
										stroke-width="8"
										stroke="currentColor"
										fill="transparent"
										r="44"
										cx="48"
										cy="48"
									/>
								</svg>
								<div
									class="absolute inset-0 flex items-center justify-center flex-col"
								>
									<div id="uploadProgress" class="text-lg font-bold">0%</div>
									<div class="text-xs font-semibold text-base-content/60">
										UP
									</div>
								</div>
							</div>
							<div class="text-right">
								<div class="text-3xl font-bold font-mono" id="uploadResult">
									-- Mbps
								</div>
								<div class="text-sm text-base-content/60" id="uploadPeak">
									Peak: -- Mbps
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Charts and History -->
			<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
				<!-- Speed Chart -->
				<div class="card bg-base-200/50 backdrop-blur-sm shadow-xl">
					<div class="card-body">
						<h2 class="card-title text-base-content/80 mb-4 flex gap-2">
							<svg
								class="w-6 h-6"
								fill="none"
								stroke="currentColor"
								viewBox="0 0 24 24"
							>
								<path
									stroke-linecap="round"
									stroke-linejoin="round"
									stroke-width="2"
									d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"
								/>
							</svg>
							Speed Over Time
						</h2>
						<div class="p-2 bg-base-100 rounded-box">
							<canvas id="speedChart" height="200"></canvas>
						</div>
					</div>
				</div>

				<!-- History -->
				<div class="card bg-base-200/50 backdrop-blur-sm shadow-xl">
					<div class="card-body">
						<div class="flex justify-between items-center mb-4">
							<h2 class="card-title text-base-content/80 flex gap-2">
								<svg
									class="w-6 h-6"
									fill="none"
									stroke="currentColor"
									viewBox="0 0 24 24"
								>
									<path
										stroke-linecap="round"
										stroke-linejoin="round"
										stroke-width="2"
										d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
									/>
								</svg>
								Test History
							</h2>
							<button
								id="clearHistory"
								class="btn btn-sm btn-error btn-outline"
							>
								Clear All
							</button>
						</div>
						<div class="overflow-x-auto">
							<table class="table table-zebra w-full">
								<thead>
									<tr class="text-base-content/70">
										<th>Time</th>
										<th>Ping</th>
										<th>Download</th>
										<th>Upload</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody id="historyBody" class="text-base-content/80"></tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Add this just before closing the container div -->
		<footer class="text-center py-8 mt-12 border-t border-base-300/20">
			<div
				class="flex flex-col md:flex-row items-center justify-center gap-4 text-base-content/60"
			>
				<div class="flex items-center gap-2">
					<svg
						class="w-5 h-5"
						fill="none"
						stroke="currentColor"
						viewBox="0 0 24 24"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="M13 10V3L4 14h7v7l9-11h-7z"
						/>
					</svg>
					<span class="font-semibold">Speed Test</span>
				</div>
				<span class="hidden md:inline text-base-content/40">•</span>
				<div class="flex items-center gap-2">
					<span>© 2024</span>
					<a href="#" class="link link-hover transition-colors"
						>Speed Test Lab</a
					>
				</div>
			</div>

			<div class="mt-4 flex flex-col items-center gap-4">
				<div class="flex items-center gap-2 text-base-content/60">
					<span>Built with</span>
					<span
						class="inline-flex items-center gap-1.5 bg-base-200/50 px-3 py-1 rounded-full"
					>
						<svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
							<path
								d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142.0852 4.783 2.7582a.7712.7712 0 0 0 .7806 0l5.8428-3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zM2.3408 7.8956a4.485 4.485 0 0 1 2.3655-1.9728V11.6a.7664.7664 0 0 0 .3879.6765l5.8144 3.3543-2.0201 1.1685a.0757.0757 0 0 1-.071 0l-4.8303-2.7865A4.504 4.504 0 0 1 2.3408 7.8956zm16.0353 3.8558L12.5313 8.3827l2.0201-1.1685a.0757.0757 0 0 1 .071 0l4.8303 2.7913a4.4944 4.4944 0 0 1-.6765 8.1042v-5.6772a.79.79 0 0 0-.4069-.6813zm2.0107-3.0231l-.142-.0852-4.7782-2.7818a.7759.7759 0 0 0-.7854 0L9.409 9.2297V6.8974a.0662.0662 0 0 1 .0284-.0615l4.8303-2.7866a4.4992 4.4992 0 0 1 6.1408 1.6465 4.4708 4.4708 0 0 1 .5346 3.0137zm-8.0468-3.4537l-2.02 1.1686a.0804.0804 0 0 1-.0759 0L5.6198 3.7812A4.485 4.485 0 0 1 8.1379 1.77a4.5057 4.5057 0 0 1 4.6042.4728l.142.0852z"
							/>
						</svg>
						<span class="font-medium">ClaudeSonnet</span>
					</span>
					<span>&</span>
					<a
						href="https://github.com/faizdotid"
						target="_blank"
						rel="noopener noreferrer"
						class="inline-flex items-center gap-1.5 bg-base-200/50 px-3 py-1 rounded-full hover:bg-base-300/50 transition-colors"
					>
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
							<path
								d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"
							/>
						</svg>
						<span class="font-medium">Faizdotid</span>
					</a>
				</div>

				<!-- Social Links -->
				<div class="flex items-center gap-4 text-base-content/60">
					<a
						href="#"
						class="hover:text-primary transition-colors"
						title="Documentation"
					>
						<svg
							class="w-5 h-5"
							fill="none"
							stroke="currentColor"
							viewBox="0 0 24 24"
						>
							<path
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
							/>
						</svg>
					</a>
					<a
						href="#"
						class="hover:text-primary transition-colors"
						title="GitHub Repository"
					>
						<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
							<path
								d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"
							/>
						</svg>
					</a>
					<a
						href="#"
						class="hover:text-primary transition-colors"
						title="Report an Issue"
					>
						<svg
							class="w-5 h-5"
							fill="none"
							stroke="currentColor"
							viewBox="0 0 24 24"
						>
							<path
								stroke-linecap="round"
								stroke-linejoin="round"
								stroke-width="2"
								d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"
							/>
						</svg>
					</a>
				</div>

				<div class="text-xs text-base-content/40">
					Version 1.0.0 | Last updated: December 2024
				</div>
			</div>
		</footer>
		<script>
			// Configuration for TailwindCSS
			// Define the main SpeedTest object
			const SpeedTest = {
				testDuration: 10000,
				downloadSize: 1048576,
				uploadSize: 1048576,
				speedChart: null,
				currentTest: null,

				async init() {
					this.setupChart();
					this.setupThemeToggle();
					this.setupDurationSlider();
					this.setupTooltips();
					this.setupEventListeners();
					this.loadHistory();

					// Restore last used duration from localStorage
					const savedDuration = localStorage.getItem("testDuration");
					if (savedDuration) {
						this.testDuration = parseInt(savedDuration);
						document.getElementById("testDuration").value =
							this.testDuration / 1000;
					}

					// Restore theme
					const savedTheme = localStorage.getItem("theme") || "light";
					document.documentElement.setAttribute("data-theme", savedTheme);
					document.querySelector(".theme-controller").checked =
						savedTheme === "dark";
				},

				setupEventListeners() {
					document
						.getElementById("startTest")
						.addEventListener("click", () => this.runTest());
					document
						.getElementById("clearHistory")
						.addEventListener("click", () => this.clearAllHistory());
				},

				setupChart() {
					const ctx = document.getElementById("speedChart").getContext("2d");
					const isDark =
						document.documentElement.getAttribute("data-theme") === "dark";

					Chart.defaults.color = isDark ? "#A6ADBA" : "#64748B";
					Chart.defaults.borderColor = isDark
						? "rgba(166, 173, 186, 0.1)"
						: "rgba(100, 116, 139, 0.1)";

					this.speedChart = new Chart(ctx, {
						type: "line",
						data: {
							labels: [],
							datasets: [
								{
									label: "Download",
									borderColor: "#2ecc71",
									backgroundColor: "rgba(46, 204, 113, 0.1)",
									borderWidth: 2,
									fill: true,
									tension: 0.4,
									data: [],
								},
								{
									label: "Upload",
									borderColor: "#f1c40f",
									backgroundColor: "rgba(241, 196, 15, 0.1)",
									borderWidth: 2,
									fill: true,
									tension: 0.4,
									data: [],
								},
							],
						},
						options: {
							responsive: true,
							animation: {
								duration: 150,
							},
							interaction: {
								intersect: false,
								mode: "index",
							},
							plugins: {
								legend: {
									position: "top",
									labels: {
										usePointStyle: true,
										padding: 15,
									},
								},
								tooltip: {
									backgroundColor: isDark ? "#2A303C" : "white",
									titleColor: isDark ? "#A6ADBA" : "#64748B",
									bodyColor: isDark ? "#A6ADBA" : "#64748B",
									borderColor: isDark ? "#242933" : "#E2E8F0",
									borderWidth: 1,
									padding: 10,
									displayColors: true,
									callbacks: {
										label: (context) =>
											`${context.dataset.label}: ${context.parsed.y.toFixed(
												1
											)} Mbps`,
									},
								},
							},
							scales: {
								x: {
									title: {
										display: true,
										text: "Time (seconds)",
										padding: 10,
									},
									grid: {
										display: false,
									},
								},
								y: {
									beginAtZero: true,
									title: {
										display: true,
										text: "Speed (Mbps)",
										padding: 10,
									},
								},
							},
						},
					});
				},

				setupThemeToggle() {
					const themeController = document.querySelector(".theme-controller");

					themeController.addEventListener("change", (e) => {
						const theme = e.target.checked ? "dark" : "light";
						document.documentElement.setAttribute("data-theme", theme);
						localStorage.setItem("theme", theme);
						this.updateChartTheme(theme === "dark");
					});
				},

				updateChartTheme(isDark) {
					if (!this.speedChart) return;

					Chart.defaults.color = isDark ? "#A6ADBA" : "#64748B";
					Chart.defaults.borderColor = isDark
						? "rgba(166, 173, 186, 0.1)"
						: "rgba(100, 116, 139, 0.1)";

					this.speedChart.options.plugins.tooltip.backgroundColor = isDark
						? "#2A303C"
						: "white";
					this.speedChart.options.plugins.tooltip.titleColor = isDark
						? "#A6ADBA"
						: "#64748B";
					this.speedChart.options.plugins.tooltip.bodyColor = isDark
						? "#A6ADBA"
						: "#64748B";
					this.speedChart.options.plugins.tooltip.borderColor = isDark
						? "#242933"
						: "#E2E8F0";

					this.speedChart.update();
				},

				setupDurationSlider() {
					const slider = document.getElementById("testDuration");
					const updateDuration = () => {
						this.testDuration = slider.value * 1000;
						localStorage.setItem("testDuration", this.testDuration.toString());
						slider.style.setProperty(
							"--value",
							((slider.value - slider.min) / (slider.max - slider.min)) * 100
						);
					};

					slider.addEventListener("input", updateDuration);
					updateDuration();
				},

				setupTooltips() {
					const tooltips = document.querySelectorAll("[data-tooltip]");
					tooltips.forEach((element) => {
						element.classList.add("tooltip");
						element.setAttribute(
							"data-tip",
							element.getAttribute("data-tooltip")
						);
					});
				},

				showStatus(message, type = "info") {
					const banner = document.getElementById("statusBanner");
					const messageEl = document.getElementById("statusMessage");

					const types = {
						info: "alert-info",
						success: "alert-success",
						warning: "alert-warning",
						error: "alert-error",
					};

					banner.className = `alert shadow-lg mb-8 max-w-2xl mx-auto ${types[type]}`;
					messageEl.textContent = message;
					banner.classList.remove("hidden");
				},
				showError(message) {
					Swal.fire({
						icon: "error",
						title: "Error",
						text: message,
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 4000,
						timerProgressBar: true,
						showClass: {
							popup: "animate__animated animate__fadeInRight animate__faster",
						},
						hideClass: {
							popup: "animate__animated animate__fadeOutRight animate__faster",
						},
					});
				},

				hideStatus() {
					document.getElementById("statusBanner").classList.add("hidden");
				},

				updateProgress(elementId, value) {
					const progressElement = document.getElementById(elementId);
					const circle = progressElement
						.closest(".relative")
						.querySelector(".progress-circle");
					const circumference = 276.46; // 2 * π * r (r = 44)

					// Update the text
					progressElement.textContent = Math.round(value) + "%";

					// Update the circle
					const offset = circumference - (value / 100) * circumference;
					circle.style.strokeDashoffset = offset;
				},

				async measureLatency(samples = 5) {
					const pings = [];

					for (let i = 0; i < samples; i++) {
						const start = performance.now();
						try {
							await fetch("?", {
								method: "POST",
								headers: {
									"Content-Type": "application/x-www-form-urlencoded",
								},
								body: "action=ping",
							});
							const end = performance.now();
							pings.push(end - start);
						} catch (error) {
							console.error("Ping measurement failed:", error);
							this.showStatus("Network error during ping test", "error");
							throw error;
						}

						this.updateProgress("pingProgress", ((i + 1) / samples) * 100);
						await new Promise((resolve) => setTimeout(resolve, 200));
					}

					const avgPing = Math.round(
						pings.reduce((a, b) => a + b) / pings.length
					);
					const jitter = Math.round(
						Math.sqrt(
							pings.reduce(
								(acc, ping) => acc + Math.pow(ping - avgPing, 2),
								0
							) / pings.length
						)
					);

					document.getElementById(
						"pingJitter"
					).textContent = `Jitter: ${jitter} ms`;
					return avgPing;
				},

				async testDownload() {
					const results = [];
					const startTime = performance.now();
					let peak = 0;

					while (performance.now() - startTime < this.testDuration) {
						try {
							const downloadStart = performance.now();
							await fetch("?", {
								method: "POST",
								headers: {
									"Content-Type": "application/x-www-form-urlencoded",
								},
								body: "action=download",
							});
							const downloadEnd = performance.now();

							const duration = (downloadEnd - downloadStart) / 1000;
							const speed = (this.downloadSize * 8) / (1000000 * duration);
							results.push(speed);
							peak = Math.max(peak, speed);

							const percent =
								((performance.now() - startTime) / this.testDuration) * 100;
							this.updateProgress("downloadProgress", Math.min(percent, 100));

							const elapsed = Math.round(
								(performance.now() - startTime) / 1000
							);
							this.updateSpeedChart(elapsed, speed, null);

							document.getElementById(
								"downloadPeak"
							).textContent = `Peak: ${Math.round(peak)} Mbps`;
						} catch (error) {
							console.error("Download test failed:", error);
							this.showStatus("Network error during download test", "error");
							throw error;
						}
					}

					return Math.round(results.reduce((a, b) => a + b) / results.length);
				},

				async testUpload() {
					const results = [];
					const startTime = performance.now();
					const testData = new Array(this.uploadSize).fill("X").join("");
					let peak = 0;

					while (performance.now() - startTime < this.testDuration) {
						try {
							const uploadStart = performance.now();
							await fetch("?", {
								method: "POST",
								headers: {
									"Content-Type": "application/x-www-form-urlencoded",
								},
								body: `action=upload&data=${testData}`,
							});
							const uploadEnd = performance.now();

							const duration = (uploadEnd - uploadStart) / 1000;
							const speed = (this.uploadSize * 8) / (1000000 * duration);
							results.push(speed);
							peak = Math.max(peak, speed);

							const percent =
								((performance.now() - startTime) / this.testDuration) * 100;
							this.updateProgress("uploadProgress", Math.min(percent, 100));

							const elapsed = Math.round(
								(performance.now() - startTime) / 1000
							);
							this.updateSpeedChart(elapsed, null, speed);

							document.getElementById(
								"uploadPeak"
							).textContent = `Peak: ${Math.round(peak)} Mbps`;
						} catch (error) {
							console.error("Upload test failed:", error);
							this.showStatus("Network error during upload test", "error");
							throw error;
						}
					}

					return Math.round(results.reduce((a, b) => a + b) / results.length);
				},

				updateSpeedChart(elapsed, downloadSpeed, uploadSpeed) {
					const chart = this.speedChart;

					if (!chart.data.labels.includes(elapsed)) {
						chart.data.labels.push(elapsed);
					}

					const downloadDataset = chart.data.datasets[0];
					const uploadDataset = chart.data.datasets[1];

					if (downloadSpeed !== null) {
						downloadDataset.data[chart.data.labels.indexOf(elapsed)] =
							downloadSpeed;
					}
					if (uploadSpeed !== null) {
						uploadDataset.data[chart.data.labels.indexOf(elapsed)] =
							uploadSpeed;
					}

					chart.update("none");
				},

				resetCharts() {
					if (this.speedChart) {
						this.speedChart.data.labels = [];
						this.speedChart.data.datasets.forEach((dataset) => {
							dataset.data = [];
						});
						this.speedChart.update();
					}
				},

				async runTest() {
					if (this.currentTest) {
						this.showStatus("Test already in progress", "warning");
						return;
					}

					const startButton = document.getElementById("startTest");
					const spinner = startButton.querySelector(".loading");

					this.currentTest = true;

					try {
						startButton.disabled = true;
						spinner.classList.remove("hidden");
						this.resetCharts();
						this.hideStatus();

						["ping", "download", "upload"].forEach((type) => {
							const progress = document.getElementById(`${type}Progress`);
							progress.style.setProperty("--value", 0);
							progress.textContent = "0%";
							document.getElementById(`${type}Result`).textContent =
								"-- " + (type === "ping" ? "ms" : "Mbps");
						});

						this.showStatus("Measuring latency...", "info");
						const ping = await this.measureLatency();
						document.getElementById("pingResult").textContent = `${ping} ms`;

						this.showStatus("Testing download speed...", "info");
						const downloadSpeed = await this.testDownload();
						document.getElementById(
							"downloadResult"
						).textContent = `${downloadSpeed} Mbps`;

						this.showStatus("Testing upload speed...", "info");
						const uploadSpeed = await this.testUpload();
						document.getElementById(
							"uploadResult"
						).textContent = `${uploadSpeed} Mbps`;

						this.addToHistory(ping, downloadSpeed, uploadSpeed);
						this.showStatus("Test completed successfully", "success");
					} catch (error) {
						console.error("Test failed:", error);
						this.showStatus(`Test failed: ${error.message}`, "error");
					} finally {
						startButton.disabled = false;
						spinner.classList.add("hidden");
						this.currentTest = false;
					}
				},

				addToHistory(ping, download, upload) {
					const row = document.createElement("tr");
					const time = new Date().toLocaleString("en-US", {
						year: "numeric",
						month: "2-digit",
						day: "2-digit",
						hour: "2-digit",
						minute: "2-digit",
						second: "2-digit",
						hour12: true,
					});

					row.innerHTML = `
        <td class="whitespace-nowrap">${time}</td>
        <td class="text-right font-mono">${ping} ms</td>
        <td class="text-right font-mono">${download} Mbps</td>
        <td class="text-right font-mono">${upload} Mbps</td>
        <td>
            <button class="btn btn-sm btn-ghost text-error hover:bg-error/20" onclick="SpeedTest.removeHistoryItem(this)" 
                    title="Remove this entry">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
        </td>
    `;

					const tbody = document.getElementById("historyBody");
					tbody.insertBefore(row, tbody.firstChild);

					while (tbody.children.length > 10) {
						tbody.removeChild(tbody.lastChild);
					}

					this.saveHistory();
				},

				async removeHistoryItem(button) {
					const row = button.closest("tr");
					const time = row.cells[0].textContent;
					const isDark =
						document.documentElement.getAttribute("data-theme") === "dark";

					const result = await Swal.fire({
						title: "Delete Test Result?",
						html: `Are you sure you want to delete the test result from <br><strong>${time}</strong>?`,
						icon: "warning",
						showCancelButton: true,
						confirmButtonText: "Delete",
						cancelButtonText: "Cancel",
						confirmButtonColor: "#e11d48",
						cancelButtonColor: "#475569",
						showClass: {
							popup: "animate__animated animate__fadeIn animate__faster",
						},
						hideClass: {
							popup: "animate__animated animate__fadeOut animate__faster",
						},
						customClass: {
							confirmButton: "btn btn-error",
							cancelButton: "btn",
							title: "font-bold",
						},
					});

					if (result.isConfirmed) {
						row.classList.add("animate-fade-out");
						setTimeout(() => {
							row.remove();
							this.saveHistory();

							// Success toast
							Swal.fire({
								icon: "success",
								title: "Test result deleted",
								toast: true,
								position: "top-end",
								showConfirmButton: false,
								timer: 3000,
								timerProgressBar: true,
								showClass: {
									popup:
										"animate__animated animate__fadeInRight animate__faster",
								},
								hideClass: {
									popup:
										"animate__animated animate__fadeOutRight animate__faster",
								},
							});
						}, 300);
					}
				},
				async clearAllHistory() {
					const result = await Swal.fire({
						title: "Clear All History?",
						text: "This action cannot be undone",
						icon: "warning",
						showCancelButton: true,
						confirmButtonText: "Clear All",
						cancelButtonText: "Cancel",
						confirmButtonColor: "#e11d48",
						cancelButtonColor: "#475569",
						showClass: {
							popup: "animate__animated animate__fadeIn animate__faster",
						},
						hideClass: {
							popup: "animate__animated animate__fadeOut animate__faster",
						},
						customClass: {
							confirmButton: "btn btn-error",
							cancelButton: "btn",
							title: "font-bold",
						},
					});

					if (result.isConfirmed) {
						document.getElementById("historyBody").innerHTML = "";
						localStorage.removeItem("speedTestHistory");

						// Success toast
						Swal.fire({
							icon: "success",
							title: "History cleared",
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
							timerProgressBar: true,
							showClass: {
								popup: "animate__animated animate__fadeInRight animate__faster",
							},
							hideClass: {
								popup:
									"animate__animated animate__fadeOutRight animate__faster",
							},
						});
					}
				},

				saveHistory() {
					try {
						const history = [];
						const rows = document.querySelectorAll("#historyBody tr");

						rows.forEach((row) => {
							const cells = row.cells;
							history.push({
								time: cells[0].textContent,
								ping: cells[1].textContent.replace(" ms", ""),
								download: cells[2].textContent.replace(" Mbps", ""),
								upload: cells[3].textContent.replace(" Mbps", ""),
							});
						});

						localStorage.setItem("speedTestHistory", JSON.stringify(history));
					} catch (e) {
						console.error("Failed to save history:", e);
					}
				},

				loadHistory() {
					try {
						const history = JSON.parse(
							localStorage.getItem("speedTestHistory") || "[]"
						);
						const tbody = document.getElementById("historyBody");
						tbody.innerHTML = "";

						history.forEach((entry) => {
							const row = document.createElement("tr");
							row.innerHTML = `
                <td class="whitespace-nowrap">${entry.time}</td>
                <td class="text-right font-mono">${entry.ping} ms</td>
                <td class="text-right font-mono">${entry.download} Mbps</td>
                <td class="text-right font-mono">${entry.upload} Mbps</td>
                <td>
                    <button class="btn btn-sm btn-ghost text-error hover:bg-error/20" onclick="SpeedTest.removeHistoryItem(this)"
                            title="Remove this entry">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </td>
            `;
							tbody.appendChild(row);
						});
					} catch (e) {
						console.error("Failed to load history:", e);
					}
				},
			};

			// Initialize when DOM is ready
			document.addEventListener("DOMContentLoaded", () => {
				SpeedTest.init();
			});
		</script>
	</body>
</html>
