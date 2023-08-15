<!DOCTYPE html>
<html>
  <head>
    <title>API Documentation</title>
    <!-- Include the Swagger UI CSS and JavaScript files -->
    <link href="/swagger/swagger-ui.css" rel="stylesheet">
  </head>
  <body>
    <div id="swagger-ui"></div>

    <!-- Include the Swagger UI JavaScript file -->
    <script src="/swagger/swagger-ui-bundle.js"></script>
    <script src="/swagger/swagger-ui-standalone-preset.js"></script>

    <!-- Initialize Swagger UI with the URL of your generated JSON documentation -->
    <script>
      window.onload = function () {
        SwaggerUIBundle({
          url: "/swagger/swagger.json",
          dom_id: '#swagger-ui',
          presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset,
          ],
        })
      }
    </script>
  </body>
</html>
