document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('cyber-bg-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    let width, height;

    function resize() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
    }

    window.addEventListener('resize', resize);
    resize();

    class TrafficLine {
        constructor() {
            this.reset();
        }

        reset() {
            this.x = Math.random() * width;
            this.y = Math.random() * height;
            this.length = Math.random() * 150 + 50;
            this.speed = Math.random() * 2 + 0.5;
            this.opacity = Math.random() * 0.5 + 0.1;
            this.vertical = Math.random() > 0.5;

            if (this.vertical) {
                this.y = Math.random() > 0.5 ? -this.length : height;
                this.dir = this.y < 0 ? 1 : -1;
            } else {
                this.x = Math.random() > 0.5 ? -this.length : width;
                this.dir = this.x < 0 ? 1 : -1;
            }
        }

        update() {
            if (this.vertical) {
                this.y += this.speed * this.dir;
                if ((this.dir === 1 && this.y > height + this.length) ||
                    (this.dir === -1 && this.y < -this.length)) {
                    this.reset();
                }
            } else {
                this.x += this.speed * this.dir;
                if ((this.dir === 1 && this.x > width + this.length) ||
                    (this.dir === -1 && this.x < -this.length)) {
                    this.reset();
                }
            }
        }

        draw() {
            ctx.beginPath();
            if (this.vertical) {
                let grad = ctx.createLinearGradient(this.x, this.y, this.x, this.y + (this.length * this.dir));
                grad.addColorStop(0, `rgba(0, 255, 255, 0)`);
                grad.addColorStop(0.5, `rgba(0, 255, 255, ${this.opacity})`);
                grad.addColorStop(1, `rgba(0, 255, 255, 0)`);
                ctx.strokeStyle = grad;
                ctx.moveTo(this.x, this.y);
                ctx.lineTo(this.x, this.y + (this.length * this.dir));
            } else {
                let grad = ctx.createLinearGradient(this.x, this.y, this.x + (this.length * this.dir), this.y);
                grad.addColorStop(0, `rgba(0, 255, 255, 0)`);
                grad.addColorStop(0.5, `rgba(0, 255, 255, ${this.opacity})`);
                grad.addColorStop(1, `rgba(0, 255, 255, 0)`);
                ctx.strokeStyle = grad;
                ctx.moveTo(this.x, this.y);
                ctx.lineTo(this.x + (this.length * this.dir), this.y);
            }
            ctx.lineWidth = 1.5;
            ctx.stroke();
        }
    }

    const lines = [];
    const numLines = Math.floor((window.innerWidth * window.innerHeight) / 25000);

    for (let i = 0; i < numLines; i++) {
        lines.push(new TrafficLine());
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        lines.forEach(line => {
            line.update();
            line.draw();
        });

        requestAnimationFrame(animate);
    }

    animate();
});

