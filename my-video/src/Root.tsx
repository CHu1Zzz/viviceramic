import "./index.css";
import { Composition, getStaticFiles } from "remotion";
import { AIVideo, aiVideoSchema } from "./components/AIVideo";
import {
  PumpkinRotation,
  pumpkinRotationSchema,
} from "./components/PumpkinRotation";
import { FPS, INTRO_DURATION } from "./lib/constants";
import { getTimelinePath, loadTimelineFromFile } from "./lib/utils";
import { PUMPKIN_ROTATION_FRAMES } from "./components/PumpkinRotation";

export const RemotionRoot: React.FC = () => {
  const staticFiles = getStaticFiles();
  const timelines = staticFiles
    .filter((file) => file.name.endsWith("timeline.json"))
    .map((file) => file.name.split("/")[1]);

  return (
    <>
      {timelines.map((storyName) => (
        <Composition
          key={storyName}
          id={storyName}
          component={AIVideo}
          fps={FPS}
          width={1080}
          height={1920}
          schema={aiVideoSchema}
          defaultProps={{
            timeline: null,
          }}
          calculateMetadata={async ({ props }) => {
            const { lengthFrames, timeline } = await loadTimelineFromFile(
              getTimelinePath(storyName),
            );

            return {
              durationInFrames: lengthFrames + INTRO_DURATION,
              props: {
                ...props,
                timeline,
              },
            };
          }}
        />
      ))}

      {/* Pumpkin Rotation - single product showcase video */}
      <Composition
        id="pumpkin-rotation"
        component={PumpkinRotation}
        fps={FPS}
        width={1080}
        height={1920}
        schema={pumpkinRotationSchema}
        defaultProps={{}}
        durationInFrames={PUMPKIN_ROTATION_FRAMES}
      />
    </>
  );
};
