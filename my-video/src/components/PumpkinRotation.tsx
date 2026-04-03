import { AbsoluteFill, useCurrentFrame, interpolate } from "remotion";
import { z } from "zod";
import { FPS } from "../lib/constants";
import { ThreeCanvas } from "@remotion/three";
import { useMemo, useEffect, useState } from "react";
import * as THREE from "three";

const PUMPKIN_IMAGE =
  "https://minimax-algeng-chat-tts.oss-cn-wulanchabu.aliyuncs.com/ccv2%2F2026-04-03%2FMiniMax-M2.7%2F2029397524166480799%2F06543d86db3f2874175f3798540762fa98c3944d132d3851ea009d5795eefaa1..png?Expires=1775285918&OSSAccessKeyId=LTAI5tGLnRTkBjLuYPjNcKQ8&Signature=v0XsYDOGFCIxmcVrVWgD%2ByWbDGQ%3D";

// Create pumpkin geometry with ridges
function createPumpkinGeometry(): THREE.BufferGeometry {
  const geometry = new THREE.SphereGeometry(1, 64, 48);
  geometry.scale(1.7, 1.25, 1.7);

  const positions = geometry.attributes.position;
  const vertex = new THREE.Vector3();

  for (let i = 0; i < positions.count; i++) {
    vertex.fromBufferAttribute(positions, i);
    const angle = Math.atan2(vertex.z, vertex.x);
    const ridgeFactor = 1 + 0.055 * Math.cos(angle * 8);
    vertex.x *= ridgeFactor;
    vertex.z *= ridgeFactor;
    const verticalSquash = 1 - Math.abs(vertex.y) * 0.06;
    vertex.x *= verticalSquash;
    vertex.z *= verticalSquash;
    positions.setXYZ(i, vertex.x, vertex.y, vertex.z);
  }

  geometry.computeVertexNormals();
  return geometry;
}

// Pumpkin mesh component
const PumpkinMesh: React.FC<{ rotation: number; floatY: number }> = ({
  rotation,
  floatY,
}) => {
  const [texture, setTexture] = useState<THREE.Texture | null>(null);

  useEffect(() => {
    const loader = new THREE.TextureLoader();
    loader.load(PUMPKIN_IMAGE, (loadedTexture) => {
      // Process to remove red background
      const canvas = document.createElement("canvas");
      canvas.width = loadedTexture.image.width;
      canvas.height = loadedTexture.image.height;
      const ctx = canvas.getContext("2d")!;
      ctx.drawImage(loadedTexture.image, 0, 0);

      const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
      const data = imageData.data;

      for (let i = 0; i < data.length; i += 4) {
        const r = data[i];
        const g = data[i + 1];
        const b = data[i + 2];
        if (r > 200 && g < 100 && b < 100) {
          data[i + 3] = 0;
        }
      }

      ctx.putImageData(imageData, 0, 0);
      const processed = new THREE.CanvasTexture(canvas);
      processed.needsUpdate = true;
      setTexture(processed);
    });
  }, []);

  const geometry = useMemo(() => createPumpkinGeometry(), []);

  if (!texture) return null;

  return (
    <mesh geometry={geometry} position={[0, floatY, 0]} rotation={[0, rotation, 0]}>
      <meshStandardMaterial
        map={texture}
        transparent
        side={THREE.DoubleSide}
        roughness={0.6}
        metalness={0.1}
      />
    </mesh>
  );
};

// Scene component
const Scene: React.FC<{ rotateY: number; floatY: number }> = ({
  rotateY,
  floatY,
}) => {
  return (
    <>
      <ambientLight intensity={0.6} color="#3a2040" />
      <directionalLight position={[2, 3, 4]} intensity={0.8} color="#ffdd88" />
      <directionalLight position={[-2, -1, -2]} intensity={0.3} color="#6b3d9a" />
      <PumpkinMesh rotation={rotateY} floatY={floatY} />
    </>
  );
};

export const PumpkinRotation: React.FC = () => {
  const frame = useCurrentFrame();

  const rotationProgress = (frame % (4 * FPS)) / (4 * FPS);
  const rotateY = rotationProgress * Math.PI * 2;

  const frame3s = frame % (3 * FPS);
  const floatY = interpolate(frame3s, [0, 1.5 * FPS, 3 * FPS], [0, -0.15, 0]);

  const frame2s = frame % (2 * FPS);
  const glowOpacity = interpolate(frame2s, [0, FPS, 2 * FPS], [0.3, 0.6, 0.3]);

  const opacity = interpolate(frame, [0, 15], [0, 1]);

  return (
    <AbsoluteFill style={{ backgroundColor: "#0a0612" }}>
      <div
        style={{
          position: "absolute",
          top: "50%",
          left: "50%",
          transform: "translate(-50%, -50%)",
          width: 864,
          height: 1152,
          background:
            "radial-gradient(ellipse at center, rgba(232, 93, 4, 0.4) 0%, rgba(212, 130, 58, 0.2) 40%, transparent 70%)",
          filter: "blur(40px)",
          opacity: glowOpacity,
        }}
      />

      <ThreeCanvas
        width={1080}
        height={1920}
        camera={{ position: [0, 0, 3.5], fov: 45 }}
        style={{ opacity }}
        gl={{ alpha: true }}
      >
        <Scene rotateY={rotateY} floatY={floatY} />
      </ThreeCanvas>

      <div
        style={{
          position: "absolute",
          inset: 0,
          background:
            "radial-gradient(ellipse at center, transparent 40%, rgba(10, 6, 18, 0.8) 100%)",
          pointerEvents: "none",
        }}
      />
    </AbsoluteFill>
  );
};

export const pumpkinRotationSchema = z.object({});

export const PUMPKIN_ROTATION_FRAMES = 5 * FPS;