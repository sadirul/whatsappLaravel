<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp API Documentation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 40px 0;
            color: white;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .content {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .nav {
            background: #f8f9fa;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .nav-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            list-style: none;
        }

        .nav-item a {
            text-decoration: none;
            color: #495057;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .nav-item a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .main-content {
            padding: 40px;
        }

        .endpoint {
            margin-bottom: 50px;
            border: 1px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .endpoint:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .endpoint-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
        }

        .endpoint-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .endpoint-method {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-right: 10px;
        }

        .endpoint-url {
            font-family: 'Monaco', 'Consolas', monospace;
            opacity: 0.9;
        }

        .endpoint-body {
            padding: 30px;
        }

        .description {
            color: #6c757d;
            margin-bottom: 25px;
            font-size: 1.1rem;
        }

        .params-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 15px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 5px;
        }

        .param {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            border-left: 4px solid #667eea;
        }

        .param-name {
            font-family: 'Monaco', 'Consolas', monospace;
            font-weight: 600;
            color: #495057;
        }

        .param-type {
            color: #6c757d;
            font-size: 0.9rem;
            margin-left: 10px;
        }

        .param-required {
            background: #dc3545;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }

        .param-optional {
            background: #28a745;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            margin-left: 10px;
        }

        .param-description {
            margin-top: 8px;
            color: #6c757d;
        }

        .curl-container {
            background: #2d3748;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            position: relative;
            overflow-x: auto;
        }

        .curl-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 15px;
        }

        .curl-title {
            color: #a0aec0;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .copy-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: absolute;
            top: 15px;
            right: 15px;
        }

        .copy-btn:hover {
            background: #5a67d8;
            transform: translateY(-1px);
        }

        .curl-code {
            font-family: 'Monaco', 'Consolas', monospace;
            font-size: 0.9rem;
            color: #e2e8f0;
            line-height: 1.5;
            white-space: pre-wrap;
            word-break: break-all;
        }

        .response-section {
            margin-top: 25px;
        }

        .response-example {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            font-family: 'Monaco', 'Consolas', monospace;
            font-size: 0.9rem;
            color: #495057;
            border: 1px solid #e9ecef;
        }

        .base-url {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .base-url-title {
            font-weight: 600;
            color: #856404;
            margin-bottom: 10px;
        }

        .base-url-text {
            font-family: 'Monaco', 'Consolas', monospace;
            color: #856404;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .main-content {
                padding: 20px;
            }
            
            .nav-list {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 WhatsApp API</h1>
            <p>Complete API documentation with ready-to-use curl examples</p>
        </div>

        <div class="content">
            <nav class="nav">
                <ul class="nav-list">
                    <li class="nav-item"><a href="#start-session">Start Session</a></li>
                    <li class="nav-item"><a href="#get-qr">Get QR Code</a></li>
                    <li class="nav-item"><a href="#send-message">Send Message</a></li>
                    <li class="nav-item"><a href="#send-file">Send File</a></li>
                    <li class="nav-item"><a href="#logout">Logout</a></li>
                </ul>
            </nav>

            <div class="main-content">
                <div class="base-url">
                    <div class="base-url-title">Base URL</div>
                    <div class="base-url-text">https://your-domain.com/api</div>
                </div>

                <!-- Start Session -->
                <div class="endpoint" id="start-session">
                    <div class="endpoint-header">
                        <div class="endpoint-title">Start WhatsApp Session</div>
                        <div>
                            <span class="endpoint-method">GET</span>
                            <span class="endpoint-url">/whatsapp/start-session?instanceKey=your-key</span>
                        </div>
                    </div>
                    <div class="endpoint-body">
                        <div class="description">
                            Initialize a new WhatsApp session instance. This endpoint creates a new session that can be used to interact with WhatsApp Web.
                        </div>

                        <div class="params-section">
                            <div class="section-title">Query Parameters</div>
                            <div class="param">
                                <span class="param-name">instanceKey</span>
                                <span class="param-type">string</span>
                                <span class="param-required">required</span>
                                <div class="param-description">Unique identifier for the WhatsApp instance</div>
                            </div>
                        </div>

                        <div class="curl-container">
                            <div class="curl-header">
                                <span class="curl-title">cURL Request</span>
                                <button class="copy-btn" onclick="copyToClipboard('start-session-curl')">Copy</button>
                            </div>
                            <code class="curl-code" id="start-session-curl">curl -X GET "https://your-domain.com/api/whatsapp/start-session?instanceKey=your-instance-key-123" \
  -H "Accept: application/json"</code>
                        </div>

                        <div class="response-section">
                            <div class="section-title">Response Example</div>
                            <div class="response-example">{
  "success": true,
  "message": "Session started successfully",
  "data": {
    "instanceKey": "your-instance-key-123",
    "status": "starting"
  }
}</div>
                        </div>
                    </div>
                </div>

                <!-- Get QR Code -->
                <div class="endpoint" id="get-qr">
                    <div class="endpoint-header">
                        <div class="endpoint-title">Get QR Code</div>
                        <div>
                            <span class="endpoint-method">GET</span>
                            <span class="endpoint-url">/whatsapp/get-qr?instanceKey=your-key</span>
                        </div>
                    </div>
                    <div class="endpoint-body">
                        <div class="description">
                            Retrieve the QR code for WhatsApp Web authentication. Scan this code with your WhatsApp mobile app to establish connection.
                        </div>

                        <div class="params-section">
                            <div class="section-title">Query Parameters</div>
                            <div class="param">
                                <span class="param-name">instanceKey</span>
                                <span class="param-type">string</span>
                                <span class="param-required">required</span>
                                <div class="param-description">Unique identifier for the WhatsApp instance</div>
                            </div>
                        </div>

                        <div class="curl-container">
                            <div class="curl-header">
                                <span class="curl-title">cURL Request</span>
                                <button class="copy-btn" onclick="copyToClipboard('get-qr-curl')">Copy</button>
                            </div>
                            <code class="curl-code" id="get-qr-curl">curl -X GET "https://your-domain.com/api/whatsapp/get-qr?instanceKey=your-instance-key-123" \
  -H "Accept: application/json"</code>
                        </div>

                        <div class="response-section">
                            <div class="section-title">Response Example</div>
                            <div class="response-example">{
  "success": true,
  "message": "QR code generated successfully",
  "data": {
    "qrCode": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...",
    "instanceKey": "your-instance-key-123"
  }
}</div>
                        </div>
                    </div>
                </div>

                <!-- Send Message -->
                <div class="endpoint" id="send-message">
                    <div class="endpoint-header">
                        <div class="endpoint-title">Send Text Message</div>
                        <div>
                            <span class="endpoint-method">POST</span>
                            <span class="endpoint-url">/whatsapp/send-message?instanceKey=your-key</span>
                        </div>
                    </div>
                    <div class="endpoint-body">
                        <div class="description">
                            Send a text message to a WhatsApp number. The instanceKey is passed as a query parameter, while message details are in the request body.
                        </div>

                        <div class="params-section">
                            <div class="section-title">Query Parameters</div>
                            <div class="param">
                                <span class="param-name">instanceKey</span>
                                <span class="param-type">string</span>
                                <span class="param-required">required</span>
                                <div class="param-description">Unique identifier for the WhatsApp instance</div>
                            </div>
                        </div>

                        <div class="params-section">
                            <div class="section-title">Body Parameters</div>
                            <div class="param">
                                <span class="param-name">number</span>
                                <span class="param-type">string</span>
                                <span class="param-required">required</span>
                                <div class="param-description">Recipient's phone number with country code (e.g., "1234567890")</div>
                            </div>
                            <div class="param">
                                <span class="param-name">message</span>
                                <span class="param-type">string</span>
                                <span class="param-required">required</span>
                                <div class="param-description">Text message content to send</div>
                            </div>
                        </div>

                        <div class="curl-container">
                            <div class="curl-header">
                                <span class="curl-title">cURL Request</span>
                                <button class="copy-btn" onclick="copyToClipboard('send-message-curl')">Copy</button>
                            </div>
                            <code class="curl-code" id="send-message-curl">curl -X POST "https://your-domain.com/api/whatsapp/send-message?instanceKey=your-instance-key-123" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "number": "1234567890",
    "message": "Hello! This is a test message from WhatsApp API."
  }'</code>
                        </div>

                        <div class="response-section">
                            <div class="section-title">Response Example</div>
                            <div class="response-example">{
  "success": true,
  "message": "Message sent successfully",
  "data": {
    "messageId": "msg_123456789",
    "number": "1234567890",
    "status": "sent"
  }
}</div>
                        </div>
                    </div>
                </div>

                <!-- Send File -->
                <div class="endpoint" id="send-file">
                    <div class="endpoint-header">
                        <div class="endpoint-title">Send File</div>
                        <div>
                            <span class="endpoint-method">POST</span>
                            <span class="endpoint-url">/whatsapp/send-file?instanceKey=your-key</span>
                        </div>
                    </div>
                    <div class="endpoint-body">
                        <div class="description">
                            Send a file (image, document, video, etc.) to a WhatsApp number using a publicly accessible URL. The instanceKey is passed as a query parameter.
                        </div>

                        <div class="params-section">
                            <div class="section-title">Query Parameters</div>
                            <div class="param">
                                <span class="param-name">instanceKey</span>
                                <span class="param-type">string</span>
                                <span class="param-required">required</span>
                                <div class="param-description">Unique identifier for the WhatsApp instance</div>
                            </div>
                        </div>

                        <div class="params-section">
                            <div class="section-title">Body Parameters</div>
                            <div class="param">
                                <span class="param-name">number</span>
                                <span class="param-type">string</span>
                                <span class="param-required">required</span>
                                <div class="param-description">Recipient's phone number with country code</div>
                            </div>
                            <div class="param">
                                <span class="param-name">fileUrl</span>
                                <span class="param-type">string (URL)</span>
                                <span class="param-required">required</span>
                                <div class="param-description">Publicly accessible URL of the file to send</div>
                            </div>
                            <div class="param">
                                <span class="param-name">caption</span>
                                <span class="param-type">string</span>
                                <span class="param-optional">optional</span>
                                <div class="param-description">Caption text to accompany the file</div>
                            </div>
                        </div>

                        <div class="curl-container">
                            <div class="curl-header">
                                <span class="curl-title">cURL Request</span>
                                <button class="copy-btn" onclick="copyToClipboard('send-file-curl')">Copy</button>
                            </div>
                            <code class="curl-code" id="send-file-curl">curl -X POST "https://your-domain.com/api/whatsapp/send-file?instanceKey=your-instance-key-123" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "number": "1234567890",
    "fileUrl": "https://example.com/files/document.pdf",
    "caption": "Here is the document you requested."
  }'</code>
                        </div>

                        <div class="response-section">
                            <div class="section-title">Response Example</div>
                            <div class="response-example">{
  "success": true,
  "message": "File sent successfully",
  "data": {
    "messageId": "file_123456789",
    "number": "1234567890",
    "fileUrl": "https://example.com/files/document.pdf",
    "status": "sent"
  }
}</div>
                        </div>
                    </div>
                </div>

                <!-- Logout -->
                <div class="endpoint" id="logout">
                    <div class="endpoint-header">
                        <div class="endpoint-title">Logout Session</div>
                        <div>
                            <span class="endpoint-method">GET</span>
                            <span class="endpoint-url">/whatsapp/logout?instanceKey=your-key</span>
                        </div>
                    </div>
                    <div class="endpoint-body">
                        <div class="description">
                            Terminate the WhatsApp session and disconnect from WhatsApp Web. This will require re-authentication via QR code for future sessions.
                        </div>

                        <div class="params-section">
                            <div class="section-title">Query Parameters</div>
                            <div class="param">
                                <span class="param-name">instanceKey</span>
                                <span class="param-type">string</span>
                                <span class="param-required">required</span>
                                <div class="param-description">Unique identifier for the WhatsApp instance to logout</div>
                            </div>
                        </div>

                        <div class="curl-container">
                            <div class="curl-header">
                                <span class="curl-title">cURL Request</span>
                                <button class="copy-btn" onclick="copyToClipboard('logout-curl')">Copy</button>
                            </div>
                            <code class="curl-code" id="logout-curl">curl -X GET "https://your-domain.com/api/whatsapp/logout?instanceKey=your-instance-key-123" \
  -H "Accept: application/json"</code>
                        </div>

                        <div class="response-section">
                            <div class="section-title">Response Example</div>
                            <div class="response-example">{
  "success": true,
  "message": "Logged out successfully",
  "data": {
    "instanceKey": "your-instance-key-123",
    "status": "disconnected"
  }
}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(elementId) {
            const element = document.getElementById(elementId);
            const textArea = document.createElement('textarea');
            textArea.value = element.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            
            try {
                document.execCommand('copy');
                // Show feedback
                const button = event.target;
                const originalText = button.textContent;
                button.textContent = 'Copied!';
                button.style.background = '#28a745';
                
                setTimeout(() => {
                    button.textContent = originalText;
                    button.style.background = '#667eea';
                }, 2000);
            } catch (err) {
                console.error('Failed to copy text: ', err);
            }
            
            document.body.removeChild(textArea);
        }

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.endpoint').forEach(endpoint => {
            endpoint.style.opacity = '0';
            endpoint.style.transform = 'translateY(20px)';
            endpoint.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(endpoint);
        });
    </script>
</body>
</html>