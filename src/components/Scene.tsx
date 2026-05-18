"use client";

import { Canvas, useFrame } from "@react-three/fiber";
import { Points, PointMaterial, Float, Sphere, MeshDistortMaterial } from "@react-three/drei";
import { useMemo, useRef, Suspense } from "react";
import * as THREE from "three";

function Starfield({ count = 3500 }: { count?: number }) {
  const ref = useRef<THREE.Points>(null);

  const positions = useMemo(() => {
    const arr = new Float32Array(count * 3);
    for (let i = 0; i < count; i++) {
      const r = 8 + Math.random() * 22;
      const theta = Math.random() * Math.PI * 2;
      const phi = Math.acos(2 * Math.random() - 1);
      arr[i * 3] = r * Math.sin(phi) * Math.cos(theta);
      arr[i * 3 + 1] = r * Math.sin(phi) * Math.sin(theta);
      arr[i * 3 + 2] = r * Math.cos(phi);
    }
    return arr;
  }, [count]);

  useFrame((_, delta) => {
    if (ref.current) {
      ref.current.rotation.y += delta * 0.02;
      ref.current.rotation.x += delta * 0.005;
    }
  });

  return (
    <Points ref={ref} positions={positions} stride={3} frustumCulled={false}>
      <PointMaterial
        transparent
        color="#cdb4ff"
        size={0.035}
        sizeAttenuation
        depthWrite={false}
      />
    </Points>
  );
}

function Planet() {
  const ref = useRef<THREE.Mesh>(null);
  useFrame((state) => {
    if (ref.current) {
      ref.current.rotation.y = state.clock.elapsedTime * 0.15;
      ref.current.rotation.x = Math.sin(state.clock.elapsedTime * 0.2) * 0.1;
    }
  });

  return (
    <Float speed={1.5} rotationIntensity={0.4} floatIntensity={0.6}>
      <Sphere ref={ref} args={[1.6, 96, 96]} position={[0, 0, 0]}>
        <MeshDistortMaterial
          color="#7b3ff2"
          emissive="#4a1eb8"
          emissiveIntensity={0.5}
          roughness={0.25}
          metalness={0.6}
          distort={0.45}
          speed={1.6}
        />
      </Sphere>
    </Float>
  );
}

function OrbitRing({ radius, tilt, color, speed }: { radius: number; tilt: number; color: string; speed: number }) {
  const ref = useRef<THREE.Mesh>(null);
  useFrame((_, delta) => {
    if (ref.current) ref.current.rotation.z += delta * speed;
  });
  return (
    <mesh ref={ref} rotation={[tilt, 0, 0]}>
      <torusGeometry args={[radius, 0.008, 16, 200]} />
      <meshBasicMaterial color={color} transparent opacity={0.55} />
    </mesh>
  );
}

function OrbitingDot({ radius, tilt, color, speed, offset }: { radius: number; tilt: number; color: string; speed: number; offset: number }) {
  const ref = useRef<THREE.Mesh>(null);
  useFrame((state) => {
    if (!ref.current) return;
    const t = state.clock.elapsedTime * speed + offset;
    const x = Math.cos(t) * radius;
    const y = Math.sin(t) * radius * Math.sin(tilt);
    const z = Math.sin(t) * radius * Math.cos(tilt);
    ref.current.position.set(x, y, z);
  });
  return (
    <mesh ref={ref}>
      <sphereGeometry args={[0.06, 16, 16]} />
      <meshBasicMaterial color={color} />
    </mesh>
  );
}

export default function Scene() {
  return (
    <Canvas
      camera={{ position: [0, 0, 6], fov: 60 }}
      dpr={[1, 1.8]}
      gl={{ antialias: true, alpha: true }}
    >
      <Suspense fallback={null}>
        <ambientLight intensity={0.4} />
        <pointLight position={[5, 5, 5]} intensity={1.8} color="#ff2bd6" />
        <pointLight position={[-5, -3, -2]} intensity={1.2} color="#2bf0ff" />
        <directionalLight position={[0, 8, 4]} intensity={0.6} color="#cdb4ff" />

        <Starfield />

        <group>
          <Planet />
          <OrbitRing radius={2.4} tilt={Math.PI / 2.2} color="#ff2bd6" speed={0.05} />
          <OrbitRing radius={3.2} tilt={Math.PI / 2.6} color="#2bf0ff" speed={-0.04} />
          <OrbitRing radius={4.0} tilt={Math.PI / 2.9} color="#7b3ff2" speed={0.03} />
          <OrbitingDot radius={2.4} tilt={0.4} color="#ff2bd6" speed={0.6} offset={0} />
          <OrbitingDot radius={3.2} tilt={-0.3} color="#2bf0ff" speed={0.4} offset={2} />
          <OrbitingDot radius={4.0} tilt={0.2} color="#cdb4ff" speed={0.3} offset={4} />
        </group>
      </Suspense>
    </Canvas>
  );
}
