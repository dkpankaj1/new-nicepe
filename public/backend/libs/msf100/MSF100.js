class MFS100Scanner {
    constructor(baseURL = "http://localhost:8004/mfs100/") {
        this.baseURL = baseURL;
    }

    async captureFingerprint() {
        try {
            console.log("Starting fingerprint capture...");
            const response = await fetch(`${this.baseURL}capture`, {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ Quality: 100, TimeOut: 10000 }),
            });

            if (!response.ok) {
                throw new Error(`HTTP Error: ${response.status} - ${response.statusText}`);
            }

            const result = await response.json();

            if (result.ErrorCode === "0") {
                const base64Image = `data:image/bmp;base64,${result.BitmapData}`;
                console.log("Fingerprint captured successfully!");
                return { success: true, data: base64Image };
            } else {
                throw new Error(result.ErrorDescription || "Unknown fingerprint error");
            }
        } catch (error) {
            console.error("MFS100 Request Error:", error.message);
            return { success: false, error: error.message };
        }
    }
}