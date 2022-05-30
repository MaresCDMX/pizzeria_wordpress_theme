const { registerBlockType } = wp.blocks;
const {
  RichText,
  InspectorControls,
  ColorPalette,
  BlockControls,
  AlignmentToolbar,
} = window.wp.blockEditor;
const { PanelBody } = window.wp.components;

/**
 *  7 Pasos para crear un bloque de Gutenberg
 * 1. Importar el componente(s) que utilizarás
 * 2. Coloca el componente donde deseas utilizarlo
 * 3. Crear una función que lea los contenidos
 * 4. Registrar un atributo
 * 5. Extraer el contenido desde props
 * 6. Guarda el contenido con setAttributes
 * 7. Lee los contenidos guardados con save()
 */

//Logo para el bloque
import { ReactComponent as Logo } from "../logo.svg";

registerBlockType("lapizzeria/boxes", {
  title: "Pizzeria Boxes",
  icon: { src: Logo },
  category: "lapizzeria",
  attributes: {
    headingBox: {
      type: "string",
      source: "html",
      selector: ".box h2",
    },
    textBox: {
      type: "string",
      source: "html",
      selector: ".box p",
    },
    colorFondo: {
      type: "string",
    },
    colorText: {
      type: "string",
    },
    textAlignment: {
      type: "string",
      default: "center",
    },
  },
  edit: (props) => {
    //Extraer los valores del atributo desde props
    console.log(props);
    const {
      attributes: { headingBox, textBox, colorFondo, colorText, textAlignment },
      setAttributes,
    } = props;
    console.log(headingBox);
    const onChangeHeadingBox = (newHeading) => {
      setAttributes({ headingBox: newHeading });
    };
    const onChangeTextBox = (newContent) => {
      setAttributes({ textBox: newContent });
    };
    const onChangeColor = (newColor) => {
      setAttributes({ colorFondo: newColor });
    };
    const onChangeTextColor = (newColor) => {
      setAttributes({ colorText: newColor });
    };
    const onChangeTextAlignment = (newAlignment) => {
      setAttributes({ textAlignment: newAlignment });
    };
    return (
      <>
        <InspectorControls>
          <PanelBody title={"Color de Fondo"} initalOpen={true}>
            <div className="components-base-control">
              <div className="components-base-control__field">
                <label className="components-base-control__label">
                  Color de Fondo
                </label>
                <ColorPalette onChange={onChangeColor} value={colorFondo} />
              </div>
            </div>
          </PanelBody>
          <PanelBody title={"Color de Texto"} initalOpen={false}>
            <div className="components-base-control">
              <div className="components-base-control__field">
                <label className="components-base-control__label">
                  Color de Texto
                </label>
                <ColorPalette onChange={onChangeTextColor} value={colorText} />
              </div>
            </div>
          </PanelBody>
        </InspectorControls>

        <BlockControls>
          <AlignmentToolbar onChange={onChangeTextAlignment} />
        </BlockControls>

        <div
          className="box"
          style={{ backgroundColor: colorFondo, textAlign: textAlignment }}
        >
          {" "}
          <h2 style={{ color: colorText }}>
            <RichText
              placeholder="Agrega el encabezado"
              onChange={onChangeHeadingBox}
              value={headingBox}
            />
          </h2>{" "}
          <p style={{ color: colorText }}>
            <RichText
              placeholder="Agrega el contenido"
              onChange={onChangeTextBox}
              value={textBox}
            />
          </p>
        </div>
      </>
    );
  },
  save: (props) => {
    const {
      attributes: { headingBox, textBox, colorFondo, colorText, textAlignment },
    } = props;
    return (
      <>
        <div
          className="box"
          style={{ backgroundColor: colorFondo, textAlign: textAlignment }}
        >
          {" "}
          <h2 style={{ color: colorText }}>
            <RichText.Content value={headingBox} />
          </h2>{" "}
          <p style={{ color: colorText }}>
            <RichText.Content value={textBox} />
          </p>
        </div>
      </>
    );
  },
});
